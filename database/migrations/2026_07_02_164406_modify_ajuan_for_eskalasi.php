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
            $table->string('file_eskalasi')->nullable()->after('catatan_dosen');
        });

        // Add ENUM value
        DB::statement("ALTER TABLE ajuan MODIFY COLUMN status ENUM('Pending', 'Disetujui', 'Reschedule', 'Ditolak', 'Selesai', 'Eskalasi WD3') DEFAULT 'Pending'");
    }

    public function down(): void
    {
        Schema::table('ajuan', function (Blueprint $table) {
            $table->dropColumn('file_eskalasi');
        });
        DB::statement("ALTER TABLE ajuan MODIFY COLUMN status ENUM('Pending', 'Disetujui', 'Reschedule', 'Ditolak', 'Selesai') DEFAULT 'Pending'");
    }
};
