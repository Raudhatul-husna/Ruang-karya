<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_users')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_event')->constrained('events')->onDelete('cascade');
            $table->dateTime('tanggal_daftar');
            $table->enum('status_pendaftaran', ['terdaftar', 'dibatalkan'])->default('terdaftar');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_events');
    }
};