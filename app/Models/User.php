<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'nim_nip',
        'nidn',
        'role',
        'email',
        'password',
        'program_studi',
        'angkatan',
        'dosen_pa_id',
        'no_whatsapp',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function reportsAsMahasiswa()
    {
        return $this->hasMany(Report::class, 'mahasiswa_id');
    }

    public function reportsAsDosen()
    {
        return $this->hasMany(Report::class, 'dosen_id');
    }

    public function dosenPA()
    {
        return $this->belongsTo(User::class, 'dosen_pa_id');
    }

    public function mahasiswaBimbingan()
    {
        return $this->hasMany(User::class, 'dosen_pa_id');
    }

    public function ajuans()
    {
        return $this->hasMany(Ajuan::class, 'mahasiswa_id');
    }
}
