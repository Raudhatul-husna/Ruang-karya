<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_users')->constrained('users')->onDelete('cascade');
            $table->string('judul_event');
            $table->text('deskripsi');
            $table->string('lokasi');
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_selesai');
            $table->dateTime('tanggal_buka_daftar');
            $table->dateTime('tanggal_tutup_daftar');
            $table->enum('status', ['aktif', 'dihapus'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};