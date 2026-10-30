<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE interaksis MODIFY jenis_interaksi ENUM('like','komentar','catatan_tempel','follow','simpan','reaksi') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE interaksis MODIFY jenis_interaksi ENUM('like','komentar','catatan_tempel','follow','simpan') NOT NULL");
    }
};
