<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    // Nama tabel (karena kamu pakai 'alat' bukan 'alats')
    protected $table = 'alat';

    // Primary key custom
    protected $primaryKey = 'id_alat';

    // Biar Laravel tahu ini auto increment int
    public $incrementing = true;
    protected $keyType = 'int';

    // Field yang boleh diisi mass assignment
    protected $fillable = [
        'nama_alat',
        'id_kategori',
        'stok',
        'deskripsi',
        'gambar',
        'kondisi',
        'status'
    ];

    // Relasi ke tabel kategori (kalau ada modelnya)
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}
