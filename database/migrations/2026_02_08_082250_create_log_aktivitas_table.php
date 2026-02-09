<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('log_aktivitas', function (Blueprint $table) {

            $table->id('id_log');

            // Relasi ke user
            $table->unsignedBigInteger('id_user');

            $table->string('aktivitas');
            $table->dateTime('waktu');

            $table->timestamps();

            // Foreign Key
            $table->foreign('id_user')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnDelete();

            // Index (biar query cepat)
            $table->index('id_user');
            $table->index('waktu');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_aktivitas');
    }
};
