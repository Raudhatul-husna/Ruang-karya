<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('karyas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_users')->constrained('users')->onDelete('cascade');
            $table->string('judul');
            $table->text('deskripsi');
            $table->enum('lorong', ['suara', 'cahaya', 'rupa', 'kata', 'panggung', 'tangan', 'digital', 'baru']);
            $table->string('file_karya')->nullable();
            $table->text('isi_teks')->nullable();
            $table->enum('status', ['aktif', 'dihapus'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('karyas');
    }
};