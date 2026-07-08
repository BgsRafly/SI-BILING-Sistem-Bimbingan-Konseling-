<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ajuan', function (Blueprint $table) {
            $table->date('tanggal_wd3')->nullable()->after('catatan_wd3');
            $table->time('waktu_wd3')->nullable()->after('tanggal_wd3');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ajuan', function (Blueprint $table) {
            $table->dropColumn(['tanggal_wd3', 'waktu_wd3']);
        });
    }
};
