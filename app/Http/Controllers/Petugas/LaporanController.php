<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;

class LaporanController extends Controller
{
    public function index()
    {
        $data = Peminjaman::with(['user','alat'])
            ->where('status','selesai')
            ->latest()
            ->get();

        // ✅ TOTAL DENDA YANG BELUM DIBAYAR
        $totalDendaBelum = $data
            ->where('status_denda', 'belum')
            ->sum('denda');

        // ✅ TOTAL DENDA YANG SUDAH DIBAYAR
        $totalDendaLunas = $data
            ->where('status_denda', 'lunas')
            ->sum('denda');

        // ✅ TOTAL SEMUA (opsional)
        $totalSemua = $totalDendaBelum + $totalDendaLunas;

        return view('petugas.laporan', compact(
            'data',
            'totalDendaBelum',
            'totalDendaLunas',
            'totalSemua'
        ));
    }
}