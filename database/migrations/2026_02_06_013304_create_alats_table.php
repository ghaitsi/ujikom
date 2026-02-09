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

            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alat');
    }
};
