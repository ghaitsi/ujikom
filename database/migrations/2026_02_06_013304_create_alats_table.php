<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('alat', function (Blueprint $table) {
        $table->increments('id_alat');
        $table->string('nama_alat');
        $table->integer('stok');
        $table->text('deskripsi')->nullable();
        $table->string('gambar')->nullable();
        $table->string('kondisi')->nullable();
        $table->enum('status', ['tersedia','dipinjam','perbaikan'])->default('tersedia');

        // Tambahkan kolom id_kategori
        $table->unsignedInteger('id_kategori')->nullable();

        // Jika mau pakai foreign key
        $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('set null');

        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('alat');
    }
};
