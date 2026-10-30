
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('interaksis', 'id_event')) {
            Schema::table('interaksis', function (Blueprint $table) {
                $table->foreignId('id_event')
                    ->nullable()
                    ->after('id_karya')
                    ->constrained('events')
                    ->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('interaksis', 'id_event')) {
            Schema::table('interaksis', function (Blueprint $table) {
                $table->dropConstrainedForeignId('id_event');
            });
        }
    }
};
