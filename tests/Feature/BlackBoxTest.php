<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class BlackBoxTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Setup Users
        $this->admin = User::create([
            'name' => 'Admin Test',
            'nim_nip' => 'admin123',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $this->dosen = User::create([
            'name' => 'Dosen Test',
            'nim_nip' => '123456789',
            'email' => 'dosen@test.com',
            'password' => Hash::make('password'),
            'role' => 'dosen',
        ]);

        $this->mahasiswa = User::create([
            'name' => 'Mahasiswa Test',
            'nim_nip' => '987654321',
            'email' => 'mahasiswa@test.com',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
            'dosen_pa_id' => $this->dosen->id,
            'program_studi' => 'informatika',
            'angkatan' => 2023,
            'no_whatsapp' => '08123456789'
        ]);

        $this->wd3 = User::create([
            'name' => 'WD3 Test',
            'nim_nip' => 'wd3123',
            'email' => 'wd3@test.com',
            'password' => Hash::make('password'),
            'role' => 'wd3',
        ]);
    }

    // AUTH-01: Login Valid
    public function test_auth_01_login_valid_redirects_to_dashboard()
    {
        $response = $this->post('/login', [
            'login_identity' => '987654321',
            'password' => 'password',
        ]);

        $response->assertRedirect('/mahasiswa/dashboard');
        $this->assertAuthenticatedAs($this->mahasiswa);
    }

    // AUTH-02: Login Tidak Valid
    public function test_auth_02_login_invalid_shows_error()
    {
        $response = $this->post('/login', [
            'login_identity' => '987654321',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors('login_identity');
        $this->assertGuest();
    }

    // AUTH-03: Registrasi Mahasiswa Baru
    public function test_auth_03_registrasi_mahasiswa_baru()
    {
        $response = $this->post('/register', [
            'name' => 'Maba Test',
            'nim_nip' => '1122334455',
            'email' => 'maba@test.com',
            'no_whatsapp' => '08987654321',
            'program_studi' => 'kimia',
            'angkatan' => 2024,
            'dosen_pa_id' => $this->dosen->id,
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/mahasiswa/dashboard');
        $this->assertAuthenticated();
    }

    // MHS-01: Membuat Pengajuan Baru
    public function test_mhs_01_create_pengajuan_baru()
    {
        $this->actingAs($this->mahasiswa);
        
        $response = $this->post('/mahasiswa/pengajuan/baru', [
            'kategori_id' => 1, 
            'subjek' => 'Bimbingan Akademik',
            'deskripsi' => 'Saya kesulitan belajar algoritma.',
        ]);

        $response->assertStatus(302);
    }

    // ADM-01: Admin Tambah Dosen
    public function test_adm_01_admin_tambah_dosen()
    {
        $this->actingAs($this->admin);

        $response = $this->post('/admin/pengguna', [
            'name' => 'Dosen Baru',
            'nip' => '10203040',
            'email' => 'dosenbaru@test.com',
            'program_studi' => 'informatika',
            'password' => 'password',
            'role' => 'dosen'
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('users', ['email' => 'dosenbaru@test.com']);
    }

    // DSN-01: Dosen Merespons Pengajuan
    public function test_dsn_01_dosen_update_status_ajuan()
    {
        $this->actingAs($this->dosen);

        $ajuan = \App\Models\Ajuan::create([
            'mahasiswa_id' => $this->mahasiswa->id,
            'dosen_id' => $this->dosen->id,
            'kategori_masalah' => 'Akademik',
            'skala_beban_pikiran' => 5,
            'skala_urgensi' => 5,
            'deskripsi_keluhan' => 'Tes',
            'harapan_mahasiswa' => 'Bisa dibantu',
            'status' => 'Pending',
            'tanggal_bimbingan' => '2026-07-09',
            'jam_bimbingan' => '10:00:00'
        ]);

        $response = $this->post('/dosen/pengajuan/' . $ajuan->id . '/status', [
            'status' => 'Disetujui',
            'catatan_dosen' => 'Baik, kita jadwalkan.',
            'jenis_pertemuan' => 'Online',
            'lokasi_atau_link' => 'https://meet.google.com/abc-defg-hij',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('ajuan', [
            'id' => $ajuan->id,
            'status' => 'Disetujui',
            'jenis_pertemuan' => 'Online'
        ]);
    }

    // DSN-02: Dosen Eskalasi ke WD3
    public function test_dsn_02_dosen_eskalasi_ke_wd3()
    {
        $this->actingAs($this->dosen);

        $ajuan = \App\Models\Ajuan::create([
            'mahasiswa_id' => $this->mahasiswa->id,
            'dosen_id' => $this->dosen->id,
            'kategori_masalah' => 'Non Akademik',
            'skala_beban_pikiran' => 5,
            'skala_urgensi' => 5,
            'deskripsi_keluhan' => 'Tes Eskalasi',
            'harapan_mahasiswa' => 'Bisa dibantu',
            'status' => 'Pending',
            'tanggal_bimbingan' => '2026-07-09',
            'jam_bimbingan' => '10:00:00'
        ]);

        $response = $this->post('/dosen/pengajuan/' . $ajuan->id . '/eskalasi', [
            'catatan_eskalasi' => 'Harap ditangani WD3 karena ini serius.'
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('ajuan', [
            'id' => $ajuan->id,
            'status' => 'Eskalasi WD3'
        ]);
    }

    // WD3-01: WD3 Menangani Eskalasi
    public function test_wd3_01_menangani_eskalasi()
    {
        $this->actingAs($this->wd3);

        $ajuan = \App\Models\Ajuan::create([
            'mahasiswa_id' => $this->mahasiswa->id,
            'dosen_id' => $this->dosen->id,
            'kategori_masalah' => 'Non Akademik',
            'skala_beban_pikiran' => 5,
            'skala_urgensi' => 5,
            'deskripsi_keluhan' => 'Tes penanganan WD3',
            'harapan_mahasiswa' => 'Bisa dibantu',
            'status' => 'Eskalasi WD3',
            'tanggal_bimbingan' => '2026-07-09',
            'jam_bimbingan' => '10:00:00'
        ]);

        $response = $this->post('/wd3/pengajuan/' . $ajuan->id . '/status', [
            'status' => 'Diproses Fakultas',
            'catatan_wd3' => 'Sedang kami bahas di tingkat fakultas.',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('ajuan', [
            'id' => $ajuan->id,
            'status' => 'Diproses Fakultas'
        ]);
    }

    // ADM-02: Tambah Kategori Bimbingan
    public function test_adm_02_admin_tambah_kategori()
    {
        $this->actingAs($this->admin);

        $response = $this->post('/admin/kategori', [
            'nama_kategori' => 'Kategori Baru BlackBox',
            'deskripsi' => 'Kategori tes blackbox',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('kategoris', [
            'nama_kategori' => 'Kategori Baru BlackBox'
        ]);
    }

    // ADM-03: Hapus Kategori Bimbingan
    public function test_adm_03_admin_hapus_kategori()
    {
        $this->actingAs($this->admin);

        $kategori = \App\Models\Kategori::create([
            'nama_kategori' => 'Kategori Hapus',
            'deskripsi' => 'Akan dihapus'
        ]);

        $response = $this->post('/admin/kategori/' . $kategori->id . '/hapus');

        $response->assertStatus(302);
        $this->assertDatabaseMissing('kategoris', [
            'id' => $kategori->id
        ]);
    }
}
