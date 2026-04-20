<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $primaryKey = 'id_peminjaman';

    public $timestamps = true;

    protected $fillable = [
        'id_user',
        'id_alat',
        'tanggal_pinjam',
        'tanggal_rencana_kembali',
        'tanggal_kembali',
        'denda',
        'status',
        'status_denda'
    ];

    // 🔥 casting biar aman & konsisten
    protected $casts = [
        'tanggal_pinjam' => 'datetime',
        'tanggal_rencana_kembali' => 'datetime',
        'tanggal_kembali' => 'datetime',
        'denda' => 'integer',
    ];

    // 🔥 DEFAULT YANG BENAR (SINKRON SAMA SYSTEM)
    protected $attributes = [
        'denda' => 0,
        'status_denda' => 'tidak_ada'
    ];

    // ===============================
    // RELASI
    // ===============================
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function alat()
    {
        return $this->belongsTo(Alat::class, 'id_alat');
    }

    // ===============================
    // 🔥 HELPER: HITUNG DENDA REALTIME
    // ===============================
    public function hitungDendaRealtime()
    {
        if (!$this->tanggal_rencana_kembali) return 0;

        $today = now();

        if ($today->greaterThan($this->tanggal_rencana_kembali)) {

            $hari = $today->copy()->startOfDay()
                ->diffInDays($this->tanggal_rencana_kembali->copy()->startOfDay());

            if ($hari == 0) {
                $hari = 1;
            }

            return $hari * 1000;
        }

        return 0;
    }

    // ===============================
    // 🔥 HELPER: STATUS DENDA OTOMATIS
    // ===============================
    public function getStatusDendaRealtimeAttribute()
    {
        $denda = $this->hitungDendaRealtime();

        if ($denda <= 0) return 'tidak_ada';

        return $this->status_denda === 'lunas' ? 'lunas' : 'belum_bayar';
    }
}