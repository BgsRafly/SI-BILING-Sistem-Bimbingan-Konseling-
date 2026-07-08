<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ajuan', function (Blueprint $table) {
            $table->text('catatan_wd3')->nullable()->after('catatan_dosen');
        });

        // Change status column to VARCHAR to allow any string
        DB::statement("ALTER TABLE ajuan MODIFY COLUMN status VARCHAR(255) DEFAULT 'Pending'");
    }

    public function down(): void
    {
        Schema::table('ajuan', function (Blueprint $table) {
            $table->dropColumn('catatan_wd3');
        });
        
        // Revert to ENUM
        DB::statement("ALTER TABLE ajuan MODIFY COLUMN status ENUM('Pending', 'Disetujui', 'Reschedule', 'Ditolak', 'Selesai', 'Eskalasi WD3') DEFAULT 'Pending'");
    }
};
