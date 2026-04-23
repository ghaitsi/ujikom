<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\Kategori;

class AlatController extends Controller
{
public function index()
{
    $alat = Alat::latest()->paginate(10);
    $totalBuku = Alat::count(); // 🔥 TAMBAHIN INI

    return view('admin.alat.index', compact('alat', 'totalBuku'));
}
    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.alat.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'penulis' => 'nullable|string|max:255',
            'tanggal_terbit' => 'nullable|date',
            'tempat_terbit' => 'nullable|string|max:255',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'stok' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'kondisi' => 'nullable|string|max:255',
            'status' => 'required|in:tersedia,dipinjam,perbaikan',
        ]);

        $data = [
            'nama_alat' => $request->nama_alat,
            'penulis' => $request->penulis,
            'tanggal_terbit' => $request->tanggal_terbit,
            'tempat_terbit' => $request->tempat_terbit,
            'id_kategori' => $request->id_kategori,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'kondisi' => $request->kondisi,
            'status' => $request->status,
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('alat', 'public');
        }

        Alat::create($data);

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil ditambahkan');
    }

    public function show($id)
    {
        $alat = Alat::findOrFail($id);
        return view('admin.alat.show', compact('alat'));
    }

    public function edit($id)
    {
        $alat = Alat::findOrFail($id);
        $kategori = Kategori::all();
        return view('admin.alat.edit', compact('alat', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $alat = Alat::findOrFail($id);

        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'penulis' => 'nullable|string|max:255',
            'tanggal_terbit' => 'nullable|date',
            'tempat_terbit' => 'nullable|string|max:255', // 🔥 FIX
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'stok' => 'required|integer',
            'status' => 'required|in:tersedia,dipinjam,perbaikan',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = [
            'nama_alat' => $request->nama_alat,
            'penulis' => $request->penulis,
            'tanggal_terbit' => $request->tanggal_terbit,
            'tempat_terbit' => $request->tempat_terbit, // 🔥 FIX UTAMA
            'id_kategori' => $request->id_kategori,
            'stok' => $request->stok,
            'status' => $request->status,
        ];

        if ($request->filled('deskripsi')) {
            $data['deskripsi'] = $request->deskripsi;
        }

        if ($request->filled('kondisi')) {
            $data['kondisi'] = $request->kondisi;
        }

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('alat', 'public');
        }

        $alat->update($data);

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil diupdate');
    }

    public function destroy($id)
    {
        $alat = Alat::findOrFail($id);
        $alat->delete();

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat dihapus');
    }
}