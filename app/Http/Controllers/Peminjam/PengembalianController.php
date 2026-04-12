<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\LogAktivitas;
use App\Models\Peminjaman;
use App\Models\Alat;

class PengembalianController extends Controller
{
    // ===============================
    // LIST ALAT YANG DIPINJAM
    // ===============================
    public function index()
    {
        $data = Peminjaman::where('id_user', Auth::id())
            ->where('status', 'dipinjam')
            ->with('alat')
            ->get()
            ->map(function ($item) {
                $item->denda = $this->hitungDenda($item->tanggal_kembali);
                return $item;
            });

        return view('peminjam.pengembalian', compact('data'));
    }


    // ===============================
    // FUNGSI HITUNG DENDA (REALTIME)
    // ===============================
    private function hitungDenda($tanggalKembali)
    {
        if (!$tanggalKembali) {
            return 0;
        }

        $hariTerlambat = now()->diffInDays($tanggalKembali, false);

        if ($hariTerlambat > 0) {
            return $hariTerlambat * 2000; // tarif denda per hari
        }

        return 0;
    }


    // ===============================
    // PROSES KEMBALIKAN
    // ===============================
    public function kembalikan($id)
    {
        $pinjam = Peminjaman::where('id_user', Auth::id())
            ->where('status','dipinjam')
            ->findOrFail($id);

        DB::transaction(function() use ($pinjam) {

            $alat = Alat::findOrFail($pinjam->id_alat);

            // HITUNG DENDA
            $denda = $this->hitungDenda($pinjam->tanggal_kembali);

            // UPDATE PEMINJAMAN
            $pinjam->update([
                'status' => 'selesai',
                'tanggal_kembali' => now() // <-- ini yang bener
            ]);

            // TAMBAH STOK
            $alat->increment('stok');

            if ($alat->stok > 0) {
                $alat->update(['status' => 'tersedia']);
            }

            // LOG AKTIVITAS
            LogAktivitas::create([
                'id_user' => Auth::id(),
                'aktivitas' => 'Mengembalikan alat: ' . $alat->nama_alat . 
                               ' | Denda: Rp ' . $denda,
                'waktu' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // SIMPAN DENDA KE SESSION
            session()->flash('denda', $denda);
        });

        return back()->with('success','Alat berhasil dikembalikan');
    }


    // ===============================
    // BAYAR DENDA
    // ===============================
    public function bayarDenda($id)
    {
        $pinjam = Peminjaman::where('id_user', Auth::id())
            ->findOrFail($id);

        $denda = $this->hitungDenda($pinjam->tanggal_kembali);

        if ($denda <= 0) {
            return back()->with('info', 'Tidak ada denda');
        }

        // kalau kamu punya field ini di database
        $pinjam->update([
            'status_denda' => 'lunas'
        ]);

        LogAktivitas::create([
            'id_user' => Auth::id(),
            'aktivitas' => 'Membayar denda: Rp ' . $denda,
            'waktu' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Denda berhasil dibayar');
    }
}