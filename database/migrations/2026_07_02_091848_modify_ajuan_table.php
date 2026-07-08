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
            $table->dropColumn('nim_mahasiswa');
            
            $table->unsignedBigInteger('mahasiswa_id')->after('id');
            $table->unsignedBigInteger('dosen_id')->after('mahasiswa_id')->nullable();

            $table->foreign('mahasiswa_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('dosen_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ajuan', function (Blueprint $table) {
            $table->dropForeign(['mahasiswa_id']);
            $table->dropForeign(['dosen_id']);
            
            $table->dropColumn(['mahasiswa_id', 'dosen_id']);
            $table->string('nim_mahasiswa')->after('id');
        });
    }
};
