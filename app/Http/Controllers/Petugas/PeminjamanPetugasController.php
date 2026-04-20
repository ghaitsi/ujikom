<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Alat;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeminjamanPetugasController extends Controller
{
    public function index()
    {
        $data = Peminjaman::with(['user', 'alat'])
            ->whereIn('status', ['menunggu', 'dipinjam'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('petugas.dashboard', compact('data'));
    }

    public function setujui($id)
    {
        $pinjam = Peminjaman::where('id_peminjaman', $id)
            ->where('status', 'menunggu')
            ->firstOrFail();

        DB::transaction(function () use ($pinjam) {

            $pinjam->update([
                'status' => 'dipinjam',
                'tanggal_pinjam' => now(),
            ]);

            $alat = Alat::findOrFail($pinjam->id_alat);
            $alat->decrement('stok');

            if ($alat->stok <= 0) {
                $alat->update(['status' => 'habis']);
            }
        });

        return redirect()->route('petugas.dashboard')
            ->with('success', 'Peminjaman berhasil disetujui');
    }

    // ===============================
    // 🔥 KONFIRMASI PENGEMBALIAN
    // ===============================
    public function kembalikan($id)
    {
        $pinjam = Peminjaman::where('id_peminjaman', $id)
            ->where('status', 'dipinjam')
            ->firstOrFail();

        DB::transaction(function () use ($pinjam) {

            $alat = Alat::findOrFail($pinjam->id_alat);

            $tanggalKembali = Carbon::now();
            $tanggalRencana = Carbon::parse($pinjam->tanggal_rencana_kembali);

            $denda = 0;

            // 🔥 HITUNG DENDA YANG BENAR
            if ($tanggalKembali->greaterThan($tanggalRencana)) {
                $hariTerlambat = $tanggalKembali->diffInDays($tanggalRencana);
                $denda = $hariTerlambat * 2000;
            }

            // 🔥 UPDATE DATA
            $pinjam->update([
                'status' => 'selesai',
                'tanggal_kembali' => $tanggalKembali,
                'denda' => $denda,
                'status_denda' => $denda > 0 ? 'belum' : 'lunas'
            ]);

            // 🔥 TAMBAH STOK
            $alat->increment('stok');

            if ($alat->stok > 0) {
                $alat->update(['status' => 'tersedia']);
            }
        });

        return redirect()->route('petugas.dashboard')
            ->with('success', 'Pengembalian berhasil dikonfirmasi');
    }

    public function tolak($id)
    {
        $pinjam = Peminjaman::where('id_peminjaman', $id)
            ->where('status', 'menunggu')
            ->firstOrFail();

        $pinjam->update([
            'status' => 'ditolak',
        ]);

        return redirect()->route('petugas.dashboard')
            ->with('success', 'Peminjaman berhasil ditolak');
    }

    public function laporan()
    {
        $data = Peminjaman::with(['user', 'alat'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('petugas.laporan.index', compact('data'));
    }
}