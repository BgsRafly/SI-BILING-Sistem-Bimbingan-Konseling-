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
        Schema::create('ajuan', function (Blueprint $table) {
            $table->id();
            $table->string('nim_mahasiswa');
            $table->string('kategori_masalah'); 
            
            // Bagian Form Prabimbingan
            $table->integer('skala_beban_pikiran');
            $table->integer('skala_urgensi');
            $table->text('deskripsi_keluhan');
            $table->text('harapan_mahasiswa');
            
            // Bagian Jadwal & Keputusan
            $table->date('tanggal_bimbingan');
            $table->time('jam_bimbingan');
            $table->enum('jenis_pertemuan', ['Online', 'Offline'])->nullable();
            $table->string('lokasi_atau_link')->nullable();
            
            $table->enum('status', ['Pending', 'Disetujui', 'Reschedule', 'Ditolak', 'Selesai'])->default('Pending');
            $table->text('catatan_dosen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ajuan');
    }
};
