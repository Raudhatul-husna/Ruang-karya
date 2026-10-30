<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_users')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_karya')->nullable()->constrained('karyas')->onDelete('cascade');
            $table->foreignId('id_target_users')->nullable()->constrained('users')->onDelete('cascade');
            $table->enum('jenis_interaksi', ['like', 'komentar', 'catatan_tempel', 'follow']);
            $table->text('isi_interaksi')->nullable();
            $table->enum('tipe_komentar', ['pujian', 'kritik', 'tanya'])->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interaksis');
    }
};