<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ajuan extends Model
{
    use HasFactory;

    protected $table = 'ajuan';

    protected $fillable = [
        'mahasiswa_id',
        'dosen_id',
        'kategori_masalah',
        'skala_beban_pikiran',
        'skala_urgensi',
        'deskripsi_keluhan',
        'harapan_mahasiswa',
        'tanggal_bimbingan',
        'jam_bimbingan',
        'jenis_pertemuan',
        'lokasi_atau_link',
        'status',
        'catatan_dosen',
        'file_eskalasi',
        'catatan_wd3',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }

    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }
}
