<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dosens = [
            [
                'nim_nip' => '198403172019031005',
                'nidn' => '0817038401',
                'name' => 'Ir. I Gusti Ngurah Anom Cahyadi Putra, ST., M.Cs',
                'email' => 'anom.cp@unud.ac.id',
                'role' => 'dosen',
                'password' => Hash::make('password'),
            ],
            [
                'nim_nip' => '196704141992031002',
                'nidn' => '0014046702',
                'name' => 'Dr. Drs. I Wayan Santiyasa,M.Si.',
                'email' => 'santiyasa@unud.ac.id',
                'role' => 'dosen',
                'password' => Hash::make('password'),
            ],
            [
                'nim_nip' => '197511052005011004',
                'nidn' => '0005117510',
                'name' => 'I Made Widhi Wirawan, S.Si., M.Si., M.Cs.',
                'email' => 'made_widhi@unud.ac.id',
                'role' => 'dosen',
                'password' => Hash::make('password'),
            ],
            [
                'nim_nip' => '198006162005011001',
                'nidn' => '0016068003',
                'name' => 'Ir. Agus Muliantara, S.Kom, M.Kom',
                'email' => 'muliantara@unud.ac.id',
                'role' => 'dosen',
                'password' => Hash::make('password'),
            ],
            [
                'nim_nip' => '198012062006041003',
                'nidn' => '0006128006',
                'name' => 'I Gede Santi Astawa, S.T., M.Cs.',
                'email' => 'santi.astawa@unud.ac.id',
                'role' => 'dosen',
                'password' => Hash::make('password'),
            ],
            [
                'nim_nip' => '198201242005021002',
                'nidn' => '0024018201',
                'name' => 'I MADE AGUS SETIAWAN, S.Kom., M.Kom',
                'email' => 'madeagus@unud.ac.id',
                'role' => 'dosen',
                'password' => Hash::make('password'),
            ],
            [
                'nim_nip' => '198212202008011008',
                'nidn' => '0020128202',
                'name' => 'Dr. I Made Widiartha, S.Si., M.Kom.',
                'email' => 'madewidiartha@unud.ac.id',
                'role' => 'dosen',
                'password' => Hash::make('password'),
            ],
            [
                'nim_nip' => '198409242008011007',
                'nidn' => '0024098402',
                'name' => 'I Komang Ari Mogi, S.Kom., M.Kom.',
                'email' => 'arimogi@unud.ac.id',
                'role' => 'dosen',
                'password' => Hash::make('password'),
            ],
            [
                'nim_nip' => '198006212008121002',
                'nidn' => '0021058003',
                'name' => 'Ida Bagus Made Mahendra, S.Kom., M.Kom.',
                'email' => 'ibm.mahendra@unud.ac.id',
                'role' => 'dosen',
                'password' => Hash::make('password'),
            ],
            [
                'nim_nip' => '198209182008122002',
                'nidn' => '0018098205',
                'name' => 'Luh Arida Ayu Rahning Putri, S.Kom., M.Cs.',
                'email' => 'rahningputri@unud.ac.id',
                'role' => 'dosen',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($dosens as $dosen) {
            User::updateOrCreate(
                ['nim_nip' => $dosen['nim_nip']],
                $dosen
            );
        }
    }
}
