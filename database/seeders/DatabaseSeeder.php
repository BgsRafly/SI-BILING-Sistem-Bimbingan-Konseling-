<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Dosen PA (Ibu Vida)
        $dosen = User::create([
            'name' => 'Vida',
            'nim_nip' => '19801234567890',
            'role' => 'dosen',
            'password' => Hash::make('vida123'),
        ]);

        // 2. Akun Mahasiswa
        User::create([
            'name' => 'Kadek Ayu Lianita Devina Sari',
            'nim_nip' => '2408561020',
            'role' => 'mahasiswa',
            'password' => Hash::make('lianita123'),
            'program_studi' => 'Informatika',
            'angkatan' => 2024,
            'dosen_pa_id' => $dosen->id,
        ]);

        // 3. Akun Wakil Dekan 3
        User::create([
            'name' => 'Wakil Dekan III',
            'nim_nip' => 'wd3',
            'role' => 'wd3',
            'password' => Hash::make('wd3123'),
        ]);

        // 4. Akun Admin / Superadmin
        User::create([
            'name' => 'Superadmin SIBILING',
            'nim_nip' => 'admin',
            'role' => 'admin',
            'password' => Hash::make('admin123'),
        ]);
    }
}