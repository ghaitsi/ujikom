<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Alat;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    // ===============================
    // DASHBOARD PEMINJAM
    // ===============================
    public function index()
    {
        $alat = Alat::where('status', 'tersedia')
            ->where('stok', '>', 0)
            ->paginate(10);

        $riwayat = Peminjaman::with('alat')
            ->where('id_user', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('peminjam.dashboard', compact('alat', 'riwayat'));
    }

    // ===============================
    // AJUKAN PINJAM (MULTI ALAT 🔥)
    // ===============================
    public function pinjam(Request $request)
    {
        $request->validate([
            'id_alat' => 'required|array',
            'id_alat.*' => 'exists:alat,id_alat',
            'tanggal_rencana_kembali' => 'required|date|after:today'
        ]);

        try {
            DB::beginTransaction();

            // 🔥 ambil semua alat yang dipilih
            $alatDipilih = Alat::whereIn('id_alat', $request->id_alat)->get();

            foreach ($alatDipilih as $alat) {

                // 🔥 cek stok
                if ($alat->stok <= 0) {
                    throw new \Exception("Stok {$alat->nama_alat} habis!");
                }

                // ===============================
                // SIMPAN PEMINJAMAN
                // ===============================
                $pinjam = Peminjaman::create([
                    'id_user' => Auth::id(),
                    'id_alat' => $alat->id_alat,
                    'tanggal_pinjam' => now(),
                    'tanggal_rencana_kembali' => $request->tanggal_rencana_kembali,
                    'tanggal_kembali' => null,
                    'denda' => 0,
                    'status' => 'menunggu',
                    'status_denda' => 'Belum'
                ]);

                // ===============================
                // LOG AKTIVITAS
                // ===============================
                LogAktivitas::create([
                    'id_user' => Auth::id(),
                    'aktivitas' => 'Mengajukan peminjaman alat: ' . $alat->nama_alat,
                    'waktu' => now()
                ]);
            }

            DB::commit();

            return back()->with(
                'success',
                '🔥 Berhasil mengajukan beberapa alat sekaligus!'
            );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->withErrors($e->getMessage());
        }
    }

    // ===============================
    // KEMBALIKAN BARANG + HITUNG DENDA
    // ===============================
    public function kembalikan($id)
    {
        try {
            DB::beginTransaction();

            $pinjam = Peminjaman::findOrFail($id);

            if ($pinjam->status !== 'disetujui') {
                return back()->withErrors('Peminjaman belum disetujui!');
            }

            $tanggalKembali = Carbon::now();
            $tanggalRencana = Carbon::parse($pinjam->tanggal_rencana_kembali);

            $denda = 0;

            if ($tanggalKembali->greaterThan($tanggalRencana)) {
                $telatHari = $tanggalKembali->diffInDays($tanggalRencana);
                $denda = $telatHari * 1000;
            }

            // update peminjaman
            $pinjam->update([
                'tanggal_kembali' => $tanggalKembali,
                'denda' => $denda,
                'status' => 'selesai',
                'status_denda' => $denda > 0 ? 'Belum' : 'Lunas'
            ]);

            // balikin stok
            $alat = Alat::find($pinjam->id_alat);
            $alat->increment('stok');

            // log
            LogAktivitas::create([
                'id_user' => Auth::id(),
                'aktivitas' => 'Mengembalikan alat: ' . $alat->nama_alat,
                'waktu' => now()
            ]);

            DB::commit();

            return back()->with('success', 'Barang berhasil dikembalikan');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->withErrors('Terjadi kesalahan saat mengembalikan barang');
        }
    }
}