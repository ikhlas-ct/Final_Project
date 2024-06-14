<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PersetujuanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TugasAkhirController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\BimbinganController;

use App\Models\Mahasiswa;
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

// // Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::put('/admin/profile/update', [AdminController::class, 'update'])->name('admin.profile.update');
    Route::put('/admin/update/password', [AdminController::class, 'updatepassword'])->name('admin.update.password');
});

// // Kaprodi routes
Route::middleware(['auth', 'role:kaprodi'])->group(function () {
    Route::get('kaprodi/dashboard', [KaprodiController::class, 'dashboard'])->name('kaprodi.dashboard');
    Route::get('persetujuan', [PersetujuanController::class, 'index'])->name('persetujuan');
    Route::post('persetujuan/simpan', [PersetujuanController::class, 'store'])->name('simpan.persetujuan');
    Route::get('persetujuan/getData', [PersetujuanController::class, 'getData'])->name('get.dataPersetujuan');
    Route::put('profileProdi/update', [KaprodiController::class, 'updateProdi'])->name('profileUpdateProdi');
    Route::put('password/Prodi/update', [KaprodiController::class, 'updatePassword'])->name('passwordUpdateProdi');
    // Route::get('kaprodi-tugas-akhir', [KaprodiController::class, 'tugasAkhir'])->name('kaprodiTugasAkhir');
});

// // Dosen routes
Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('pengajuan', [PengajuanController::class, 'index'])->name('pengajuan');
    Route::get('pengajuan/getData', [PengajuanController::class, 'getData'])->name('get.dataPengajuan');
    Route::put('/pengajuan/update-status/{id}', [PengajuanController::class, 'updateStatus'])->name('pengajuan.update-status');


    // 
    Route::get('dosen/dashboard', [DosenController::class, 'dashboard'])->name('dosen.dashboard');
    Route::get('dosen/profile', [DosenController::class, 'profile'])->name('dosen.profile');
    Route::put('/dosen/profile/update', [DosenController::class, 'updateProfile'])->name('dosen.profile.update');
    Route::get('/mhs-bimbingan', [DosenController::class, 'mhsBimbingan'])->name('mhsBimbingan');
    Route::get('/konsultasi', [DosenController::class, 'konsultasi_show'])->name('Halaman_Konsultasi');
    Route::put('/dosen/update/password', [DosenController::class, 'updatepassword'])->name('dosen.update.password');
});

// // Mahasiswa routes
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
    // Route::get('mahasiswa/dashboard', [MahasiswaController::class, 'index'])->name('halamanDashboard');
    // Route::get('/pilih-pembimbing', [MahasiswaController::class, 'pilihPembimbing'])->name('pilihPembimbing');
    // Route::get('/tugas-akhir', [MahasiswaController::class, 'tugasAkhir'])->name('tugasAkhir');
    // Route::get('/tugas-akhir-create', [MahasiswaController::class, 'tugasAkhirCreate'])->name('tugasAkhirCreate');
    // Route::post('/tugas-akhir', [MahasiswaController::class, 'StoreTugasAkhir'])->name('StoreTugasAkhir');
    // Route::put('/profile/update', [MahasiswaController::class, 'update'])->name('profileUpdate');
    // Route::put('/passwordProdi/update', [MahasiswaController::class, 'updatePassword'])->name('passwordUpdateMahasiswa');
    // Route::get('/konsultasi', [MahasiswaController::class, 'konsul'])->name('halamanKonsultasi');
    // Route::get('/tgl_penting', [MahasiswaController::class, 'tgl_penting'])->name('halamanTanggal');
});

// // Fallback route
// Route::fallback(function () {
//     $user = Auth::user();
//     if ($user) {
//         switch ($user->role) {
//             case 'admin':
//                 return redirect()->route('admin.dashboard');
//             case 'kaprodi':
//                 return redirect()->route('kaprodi.dashboard');
//             case 'dosen':
//                 return redirect()->route('dosen.dashboard');
//             case 'mahasiswa':
//                 return redirect()->route('halamanDashboard');
//             default:
//                 return redirect('/'); // default page
//         }
//     }
//     return redirect()->route('login');
// });
