<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    public function index()
    {
        $data = Peminjaman::with(['user', 'alat'])
            ->where('status', 'selesai')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        // Hitung statistik untuk cards
        $totalPengembalian = $data->total();
        $tepatWaktu = 0;
        $terlambat = 0;
        $totalDenda = 0;
        
        foreach ($data as $row) {
            $rencanaKembali = Carbon::parse($row->tanggal_rencana_kembali);
            $tanggalKembali = Carbon::parse($row->tanggal_kembali); // Pasti ada karena status selesai
            
            // Hitung selisih tanggal kembali dengan rencana kembali
            $hariTerlambat = $tanggalKembali->diffInDays($rencanaKembali, false);
            
            if ($hariTerlambat > 0) {
                $terlambat++;
                $denda = $hariTerlambat * 5000; // Rp 5.000 per hari
                $totalDenda += $denda; // Akumulasi semua denda
            } else {
                $tepatWaktu++;
                // $denda = 0 (tidak perlu ditambahkan)
            }
        }

        return view('admin.pengembalian.index', compact(
            'data', 
            'totalPengembalian', 
            'tepatWaktu', 
            'terlambat', 
            'totalDenda'
        ));
    }
}