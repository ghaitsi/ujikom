<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;

class LaporanController extends Controller
{
    public function index()
    {
        $data = Peminjaman::with(['user','alat'])
            ->where('status','dikembalikan')
            ->latest()
            ->get();

        return view('Petugas.laporan', compact('data'));
    }
}
