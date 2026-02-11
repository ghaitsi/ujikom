<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Alat;

class CekPeminjamanController extends Controller
{
    public function index()
    {
        $data = Peminjaman::with(['user','alat'])
            ->latest()
            ->paginate(10);

        return view('admin.peminjaman.index', compact('data'));
    }

    public function create()
    {
        $users = User::all();
        $alat = Alat::all();

        return view('admin.peminjaman.create', compact('users','alat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'id_alat' => 'required',
            'tanggal_pinjam' => 'required|date',
            'tanggal_rencana_kembali' => 'nullable|date'
        ]);

        Peminjaman::create($request->all());

        return redirect()->route('admin.peminjaman.index')
            ->with('success','Peminjaman berhasil dibuat');
    }

    public function show($id)
    {
        $data = Peminjaman::findOrFail($id);
        return view('admin.peminjaman.show', compact('data'));
    }

    public function edit($id)
    {
        $data = Peminjaman::findOrFail($id);
        $users = User::all();
        $alat = Alat::all();

        return view('admin.peminjaman.edit', compact('data','users','alat'));
    }

    public function update(Request $request, $id)
    {
        $data = Peminjaman::findOrFail($id);

        $data->update($request->all());

        return redirect()->route('admin.peminjaman.index')
            ->with('success','Data diperbarui');
    }

    public function destroy($id)
    {
        $data = Peminjaman::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.peminjaman.index')
            ->with('success','Data dihapus');
    }
}
