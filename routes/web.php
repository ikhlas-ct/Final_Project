<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PersetujuanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TugasAkhirController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\BimbinganController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\MembimbingController;
use App\Http\Controllers\TemaController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::view('/', 'layout.master');
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::middleware(['auth', 'role:admin'])->group(function () {
        // admin
        Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::put('/admin/profile/update', [AdminController::class, 'update'])->name('admin.profile.update');
        // pengguna
        Route::get('/admin/users', [AdminController::class, 'pengguna'])->name('admin.users');
        Route::get('/admin/users/{role}', [AdminController::class, 'filterByRole'])->name('admin.users.filter');
        Route::put('/admin/users/{id}', [AdminController::class, 'update_user'])->name('admin.users.update');
        Route::delete('admin/users/delete/{id}', [AdminController::class, 'destroy'])->name('admin.users.delete');
        Route::post('/admin/users/tambah', [AdminController::class, 'tambah'])->name('admin.users.tambah');
        //fakultas
        Route::get('/admin/fakultas', [AdminController::class, 'index_fakultas'])->name('fakultas.index');
        Route::post('/fakultas/store', [AdminController::class, 'store_fakultas'])->name('fakultas.store');
        // Route::get('/admin/fakultas', [AdminController::class, 'index_fakultas'])->name('fakultas.index');
        Route::get('/admin/fakultas/{id}/edit', [AdminController::class, 'edit_fakultas'])->name('fakultas.edit');
        Route::put('/fakultas/update/{id}', [AdminController::class, 'update_fakultas'])->name('fakultas.update');
        Route::delete('/fakultas/delete/{id}', [AdminController::class, 'destroy_fakultas'])->name('fakultas.destroy');
    });
});

// Kaprodi routes
Route::middleware(['auth', 'role:kaprodi'])->group(function () {
    Route::get('kaprodi/dashboard', [KaprodiController::class, 'dashboard'])->name('kaprodi.dashboard');
    Route::get('persetujuan', [PersetujuanController::class, 'index'])->name('persetujuan');
    Route::post('persetujuan/simpan', [PersetujuanController::class, 'store'])->name('simpan.persetujuan');
    Route::get('persetujuan/getData', [PersetujuanController::class, 'getData'])->name('get.dataPersetujuan');
    Route::get('/tema-pengajuan', [TemaController::class, 'index'])->name('temaIndex');
    Route::get('/addTema', [TemaController::class, 'addTema'])->name('halamanTambahTema');
    Route::post('/addTema', [TemaController::class, 'storeTema'])->name('SimpanTema');
    Route::get('/editTema/{id}', [TemaController::class, 'editTema'])->name('halamanEditTema');
    Route::put('/updateTema/{id}', [TemaController::class, 'updateTema'])->name('updateTema');
    Route::get('/detailTema/{id}', [TemaController::class, 'showTema'])->name('DetailTema');
    Route::delete('/deleteTema/{id}', [TemaController::class, 'hapusTema'])->name('DeleteTema');

    Route::put('/kaprodi/profile/update', [ProfileController::class, 'updateProfileKprd'])->name('kaprodi.profile.update');;
});

// Dosen routes
Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('pengajuan', [PengajuanController::class, 'index'])->name('pengajuan');
    Route::get('pengajuan/getData', [PengajuanController::class, 'getData'])->name('get.dataPengajuan');
    Route::put('/pengajuan/update-status/{id}', [PengajuanController::class, 'updateStatus'])->name('pengajuan.update-status');
    
    Route::get('/membimbing', [MembimbingController::class, 'index'])->name('membimbing');
    Route::put('/bimbingan/update/{id}', [BimbinganController::class, 'update'])->name('bimbingan.update');
    Route::post('/bimbingan/reschedule/{id}', [BimbinganController::class, 'reschedule'])->name('bimbingan.reschedule');
    
    Route::get('dosen/dashboard', [DosenController::class, 'dashboard'])->name('dosen.dashboard');
    Route::get('dosen/profile', [DosenController::class, 'profile'])->name('dosen.profile');
    Route::put('/dosen/profile/update', [ProfileController::class, 'updateProfileDsn'])->name('dosen.profile.update');
    Route::get('/mhs-bimbingan', [DosenController::class, 'mhsBimbingan'])->name('mhsBimbingan');
    Route::get('/konsultasi', [DosenController::class, 'konsultasi_show'])->name('Halaman_Konsultasi');
    Route::put('/dosen/update/password', [DosenController::class, 'updatepassword'])->name('dosen.update.password');
    
    Route::get('/dosen/membimbing/{id}', [MembimbingController::class, 'show'])->name('membimbing.show');
    Route::put('/dosen/selesai/membimbing/{id}', [MembimbingController::class, 'update'])->name('selesai.membimbing');
});

// Mahasiswa routes
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/tugas-akhir', [TugasAkhirController::class, 'index'])->name('tugasAkhir');
    Route::get('/tugas-akhir/getData', [TugasAkhirController::class, 'getData'])->name('tugasAkhirGetData');
    Route::get('/create-tugas-akhir', [TugasAkhirController::class, 'create'])->name('create.tugasAkhirCreate');
    Route::post('/store-tugas-akhir', [TugasAkhirController::class, 'store'])->name('store.TugasAkhir');
    Route::get('/pilih-pembimbing-tugas-akhir/{id}', [TugasAkhirController::class, 'pilihPembimbing'])->name('pilih.pembimbingTugasAkhir');
    Route::post('/store-pilih-pembimbing-tugas-akhir', [TugasAkhirController::class, 'storePilihPembimbing'])->name('store.pilihPembimbingTugasAkhir');
    Route::post('/store-ambil-pembimbing-tugas-akhir', [TugasAkhirController::class, 'storeAmbilPembimbing'])->name('store.ambilPembimbingTugasAkhir');
    Route::get('/bimbingan', [BimbinganController::class, 'index'])->name('bimbingan');
    Route::post('/bimbingan/store', [BimbinganController::class, 'store'])->name('store.bimbingan');
    Route::get('/logbook', [LogbookController::class, 'index'])->name('logbook');
    Route::post('/logbook/simpan', [LogbookController::class, 'store'])->name('simpan.logbook');
    Route::get('/generate-pdf/{id}', [PdfController::class, 'generatePDF'])->name('generate-pdf');
    Route::put('/mahasiswa/profile/update', [ProfileController::class, 'updateProfileMhs'])->name('mahasiswa.profile.update');
});