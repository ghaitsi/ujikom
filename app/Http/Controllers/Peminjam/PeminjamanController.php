<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Alat;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    // ===============================
    // DASHBOARD PEMINJAM
    // ===============================
    public function index()
    {
        // Alat yang tersedia untuk dipinjam
        $alat = Alat::where('status', 'tersedia')
            ->where('stok', '>', 0)
            ->paginate(10);

        // Riwayat peminjaman user login
        $riwayat = Peminjaman::with('alat')
            ->where('id_user', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('peminjam.dashboard', compact('alat', 'riwayat'));
    }

    // ===============================
    // AJUKAN PINJAM
    // ===============================
    public function pinjam(Request $request)
    {
        $request->validate([
            'id_alat' => 'required|exists:alat,id_alat',
            'tanggal_rencana_kembali' => 'required|date|after:today'
        ]);

        try {

            DB::beginTransaction();

            $alat = Alat::findOrFail($request->id_alat);

            // Cek stok
            if ($alat->stok <= 0) {
                return back()->withErrors('Stok alat habis!');
            }

            // Simpan peminjaman
            $pinjam = Peminjaman::create([
                'id_user' => Auth::id(),
                'id_alat' => $request->id_alat,
                'tanggal_pinjam' => now(),
                'tanggal_rencana_kembali' => $request->tanggal_rencana_kembali,
                'status' => 'menunggu',
            ]);

            // ✅ LOG AKTIVITAS
            LogAktivitas::create([
                'id_user' => Auth::id(),
                'aktivitas' => 'Mengajukan peminjaman alat ID '.$pinjam->id_alat,
                'waktu' => now()
            ]);

            DB::commit();

            return back()->with(
                'success',
                'Permintaan peminjaman berhasil dikirim. Menunggu persetujuan petugas.'
            );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->withErrors(
                'Terjadi kesalahan saat mengajukan peminjaman'
            );
        }
    }
}
