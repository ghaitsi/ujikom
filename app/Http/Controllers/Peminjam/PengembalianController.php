<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            ->get();

        return view('peminjam.pengembalian', compact('data'));
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

            // Update status peminjaman
            $pinjam->update([
                'status' => 'selesai'
            ]);

            // Tambah stok alat
            $alat = Alat::findOrFail($pinjam->id_alat);
            $alat->increment('stok');

            // Update status tersedia lagi
            if ($alat->stok > 0) {
                $alat->update(['status' => 'tersedia']);
            }

        });

        return back()->with('success','Alat berhasil dikembalikan');
    }
}
