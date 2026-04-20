<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\LogAktivitas;
use App\Models\Peminjaman;
use App\Models\Alat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    // ===============================
    // HITUNG DENDA REALTIME
    // ===============================
    private function hitungDenda($tanggalRencana)
    {
        if (!$tanggalRencana) return 0;

        $now = Carbon::now();
        $rencana = Carbon::parse($tanggalRencana);

        if ($now->lte($rencana)) {
            return 0;
        }

        $hariTerlambat = ceil($rencana->diffInHours($now) / 24);

        return $hariTerlambat * 1000;
    }

    // ===============================
    // KEMBALIKAN TANPA BAYAR
    // ===============================
    public function kembalikan($id)
    {
        $pinjam = Peminjaman::where('id_user', Auth::id())
            ->where('status', 'dipinjam')
            ->findOrFail($id);

        DB::transaction(function () use ($pinjam) {
            $alat = Alat::findOrFail($pinjam->id_alat);

            $dendaSaatIni = $this->hitungDenda($pinjam->tanggal_rencana_kembali);

            $pinjam->update([
                'status' => 'selesai',
                'tanggal_kembali' => now(),
            ]);

            $alat->increment('stok');

            if ($alat->stok > 0) {
                $alat->update(['status' => 'tersedia']);
            }

            LogAktivitas::create([
                'id_user' => Auth::id(),
                'aktivitas' => 'Mengembalikan alat: ' . $alat->nama_alat .
                               ' | Denda saat itu: Rp ' . number_format($dendaSaatIni, 0, ',', '.') . ' (tidak disimpan)',
                'waktu' => now(),
            ]);
        });

        return back()->with('success', 'Alat berhasil dikembalikan');
    }

    // ===============================
    // BAYAR DENDA + KEMBALIKAN (AUTO LUNAS)
    // ===============================
    public function bayarDendaDanKembalikan(Request $request, $id)
    {
        $pinjam = Peminjaman::where('id_user', Auth::id())
            ->where('status', 'dipinjam')
            ->findOrFail($id);

        $totalDenda = $this->hitungDenda($pinjam->tanggal_rencana_kembali);

        if ($totalDenda <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada denda!'
            ], 400);
        }

        DB::transaction(function () use ($pinjam, $totalDenda) {
            $alat = Alat::findOrFail($pinjam->id_alat);

            // 🔥 FIX UTAMA: LANGSUNG LUNAS
            $pinjam->update([
                'denda' => $totalDenda,
                'status_denda' => 'lunas',
                'status' => 'selesai',
                'tanggal_kembali' => now()
            ]);

            $alat->increment('stok');

            if ($alat->stok > 0) {
                $alat->update(['status' => 'tersedia']);
            }

            LogAktivitas::create([
                'id_user' => Auth::id(),
                'aktivitas' => 'Membayar denda Rp ' . number_format($totalDenda, 0, ',', '.') .
                               ' (LUNAS) | Alat: ' . $alat->nama_alat,
                'waktu' => now(),
            ]);
        });

        return response()->json([
            'success' => true,
            'message' => '✅ Denda lunas & alat dikembalikan'
        ]);
    }

    // ===============================
    // BAYAR SISA DENDA
    // ===============================
    public function bayarDendaSaja($id)
    {
        $pinjam = Peminjaman::where('id_user', Auth::id())
            ->where('status', 'selesai')
            ->findOrFail($id);

        if ($pinjam->denda <= 0) {
            return back()->with('info', 'Tidak ada denda');
        }

        if ($pinjam->status_denda == 'lunas') {
            return back()->with('info', 'Denda sudah lunas');
        }

        $pinjam->update([
            'status_denda' => 'lunas'
        ]);

        LogAktivitas::create([
            'id_user' => Auth::id(),
            'aktivitas' => 'Melunasi denda Rp ' . number_format($pinjam->denda, 0, ',', '.'),
            'waktu' => now(),
        ]);

        return back()->with('success', 'Denda berhasil dilunasi');
    }
}