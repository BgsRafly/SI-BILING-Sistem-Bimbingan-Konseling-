<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\WD3Controller;

Route::get('/', function () { return view('welcome'); });
Route::get('/login', function () { return view('login'); })->name('login');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');

Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dosen/dashboard', [DosenController::class, 'dashboard']);
    Route::get('/dosen/pengajuan', [DosenController::class, 'pengajuan']);
    Route::get('/dosen/pengajuan/{id}', [DosenController::class, 'showAjuan']);
    Route::post('/dosen/pengajuan/{id}/status', [DosenController::class, 'updateAjuanStatus']);
    Route::post('/dosen/pengajuan/{id}/eskalasi', [DosenController::class, 'prosesEskalasi']);
    Route::get('/dosen/riwayat', [DosenController::class, 'riwayat']);
    Route::get('/dosen/eskalasi', [DosenController::class, 'eskalasi']);
    Route::get('/dosen/bimbingan_pa', [DosenController::class, 'bimbinganPA']);
    Route::get('/dosen/laporan', [DosenController::class, 'laporan']);
    Route::get('/dosen/laporan/ekspor', [DosenController::class, 'eksporLaporan']);
    Route::get('/dosen/laporan/{id}/pdf', [DosenController::class, 'eksporDetailPdf']);
    Route::get('/dosen/pengaturan', [DosenController::class, 'pengaturan']);

    Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'dashboard']);
    Route::get('/mahasiswa/pengajuan/baru', [MahasiswaController::class, 'createAjuan']);
    Route::post('/mahasiswa/pengajuan/baru', [MahasiswaController::class, 'storeAjuan']);
    Route::get('/mahasiswa/pengajuan/{id}', [MahasiswaController::class, 'showAjuan']);
    Route::post('/mahasiswa/pengajuan/{id}/batal', [MahasiswaController::class, 'batalAjuan']);
    Route::get('/mahasiswa/riwayat', [MahasiswaController::class, 'riwayat']);
    Route::get('/mahasiswa/profil', [MahasiswaController::class, 'profil']);
    Route::post('/mahasiswa/profil', [MahasiswaController::class, 'updateProfil']);

    Route::middleware('auth')->group(function () {
        Route::get('/wd3/dashboard', [WD3Controller::class, 'dashboard']);
        Route::get('/wd3/eskalasi', [WD3Controller::class, 'eskalasi']);
        Route::get('/wd3/rujukan', [WD3Controller::class, 'rujukan']);
        Route::get('/wd3/riwayat', [WD3Controller::class, 'riwayat']);
        Route::get('/wd3/pengajuan/{id}', [WD3Controller::class, 'show']);
        Route::post('/wd3/pengajuan/{id}/status', [WD3Controller::class, 'updateStatus']);
    });

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    // Dosen Management
    Route::get('/admin/pengguna', [AdminController::class, 'pengguna']);
    Route::post('/admin/pengguna', [AdminController::class, 'storeDosen']);
    Route::put('/admin/pengguna/{id}', [AdminController::class, 'updateDosen']);
    Route::delete('/admin/pengguna/{id}', [AdminController::class, 'destroyDosen']);

    // Kategori Management
    Route::get('/admin/kategori', [AdminController::class, 'kategori']);
    Route::post('/admin/kategori', [AdminController::class, 'storeKategori']);
    Route::post('/admin/kategori/{id}', [AdminController::class, 'updateKategori']);
    Route::post('/admin/kategori/{id}/hapus', [AdminController::class, 'destroyKategori']);

    // Admin Laporan
    Route::get('/admin/laporan', [AdminController::class, 'laporan']);
    Route::get('/admin/laporan/ekspor', [AdminController::class, 'exportCsv']);
    Route::get('/admin/laporan/pdf', [AdminController::class, 'exportLaporanPdf']);
    Route::post('/admin/laporan/{id}/status', [AdminController::class, 'updateStatusLaporan']);
    Route::get('/admin/dashboard/pdf', [AdminController::class, 'exportPdf']);
});