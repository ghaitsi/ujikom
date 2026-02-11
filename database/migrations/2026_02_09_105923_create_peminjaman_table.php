<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {

            $table->increments('id_peminjaman');

            // HARUS cocok dengan users.id (BIGINT)
            $table->unsignedBigInteger('id_user');

            // Cocok dengan alat.id_alat (INT)
            $table->unsignedInteger('id_alat');

            $table->date('tanggal_pinjam');
            $table->date('tanggal_rencana_kembali')->nullable();

            $table->enum('status', [
                'menunggu',
                'disetujui',
                'ditolak',
                'dipinjam',
                'selesai'
            ])->default('menunggu');

            $table->timestamps();

            // Foreign Keys
            $table->foreign('id_user')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('id_alat')
                ->references('id_alat')
                ->on('alat')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
