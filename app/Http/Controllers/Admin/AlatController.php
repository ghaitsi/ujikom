<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\Kategori; // jangan lupa import model Kategori

class AlatController extends Controller
{
    public function index()
    {
        // Ambil alat beserta kategori
        $alat = Alat::latest()->paginate(10);
        return view('admin.alat.index', compact('alat'));
    }

    public function create()
    {
        // Ambil semua kategori untuk dropdown
        $kategori = Kategori::all();
        return view('admin.alat.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'stok' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'kondisi' => 'nullable|string',
            'status' => 'required|in:tersedia,dipinjam,perbaikan',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('alat', 'public');
        }

        Alat::create($data);

        return redirect()->route('admin.alat.index')
            ->with('success','Alat berhasil ditambahkan');
    }

    public function show($id)
    {
        $alat = Alat::findOrFail($id);
        return view('admin.alat.show', compact('alat'));
    }

    public function edit($id)
    {
        $alat = Alat::findOrFail($id);
        $kategori = Kategori::all(); // ambil kategori untuk dropdown
        return view('admin.alat.edit', compact('alat', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $alat = Alat::findOrFail($id);

        $request->validate([
            'nama_alat' => 'required',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'stok' => 'required|integer',
            'status' => 'required|in:tersedia,dipinjam,perbaikan',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('alat', 'public');
        }

        $alat->update($data);

        return redirect()->route('admin.alat.index')
            ->with('success','Alat berhasil diupdate');
    }

    public function destroy($id)
    {
        $alat = Alat::findOrFail($id);
        $alat->delete();

        return redirect()->route('admin.alat.index')
            ->with('success','Alat dihapus');
    }
}
