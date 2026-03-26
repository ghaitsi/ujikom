<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Alat;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $primaryKey = 'id_kategori';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'nama_kategori'
    ];

    public $timestamps = true;

    // ===============================
    // RELASI KE ALAT
    // ===============================
    public function alat()
    {
        return $this->hasMany(Alat::class, 'id_kategori', 'id_kategori');
    }
}
