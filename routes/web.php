<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PersetujuanController;
use App\Http\Controllers\ProfileController;
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
    Route::middleware(['auth', 'role:admin'])->group(function () {
        // admin
        Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::put('/admin/profile/update', [AdminController::class, 'update'])->name('admin.profile.update');
        Route::put('/admin/update/password', [AdminController::class, 'updatepassword'])->name('admin.update.password');
        // pengguna
        Route::get('/admin/users', [AdminController::class, 'pengguna'])->name('admin.users');
        Route::get('/admin/users/{role}', [AdminController::class, 'filterByRole'])->name('admin.users.filter');
        Route::put('/admin/users/{id}', [AdminController::class, 'update_user'])->name('admin.users.update');
        Route::delete('admin/users/delete/{id}', [AdminController::class, 'destroy'])->name('admin.users.delete');
        Route::post('/admin/users/tambah', [AdminController::class, 'tambah'])->name('admin.users.tambah');
        //fakultas
        Route::get('/admin/fakultas', [AdminController::class, 'index_fakultas'])->name('fakultas.index');
        Route::post('/fakultas/store', [AdminController::class, 'store_fakultas'])->name('fakultas.store');
        Route::get('/admin/fakultas', [AdminController::class, 'index_fakultas'])->name('fakultas.index');
        Route::get('/admin/fakultas/{id}/edit', [AdminController::class, 'edit_fakultas'])->name('fakultas.edit');
        Route::put('/fakultas/update/{id}', [AdminController::class, 'update_fakultas'])->name('fakultas.update');
        Route::delete('/fakultas/delete/{id}', [AdminController::class, 'destroy_fakultas'])->name('fakultas.destroy');
                        

    });
});

// // Kaprodi routes
Route::middleware(['auth', 'role:kaprodi'])->group(function () {
    Route::get('kaprodi/dashboard', [KaprodiController::class, 'dashboard'])->name('kaprodi.dashboard');
    Route::get('persetujuan', [PersetujuanController::class, 'index'])->name('persetujuan');
    Route::post('persetujuan/simpan', [PersetujuanController::class, 'store'])->name('simpan.persetujuan');
    Route::get('persetujuan/getData', [PersetujuanController::class, 'getData'])->name('get.dataPersetujuan');;
    Route::put('profileProdi/update', [KaprodiController::class, 'updateProdi'])->name('profileUpdateProdi');
    Route::put('password/Prodi/update', [KaprodiController::class, 'updatePassword'])->name('passwordUpdateProdi');
    // Route::get('kaprodi-tugas-akhir', [KaprodiController::class, 'tugasAkhir'])->name('kaprodiTugasAkhir');
});

// // Dosen routes
Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('dosen/dashboard', [DosenController::class, 'dashboard'])->name('dosen.dashboard');
    Route::get('dosen/profile', [DosenController::class, 'profile'])->name('dosen.profile');
    Route::put('/dosen/profile/update', [DosenController::class, 'updateProfile'])->name('dosen.profile.update');
    Route::get('/konsultasi', [DosenController::class, 'konsultasi_show'])->name('Halaman_Konsultasi');
    Route::put('/dosen/update/password', [DosenController::class, 'updatepassword'])->name('dosen.update.password');
});

// // Mahasiswa routes
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('mahasiswa/dashboard', [MahasiswaController::class, 'index'])->name('halamanDashboard');
    Route::get('/pilih-pembimbing', [MahasiswaController::class, 'pilihPembimbing'])->name('pilihPembimbing');
    Route::get('/tugas-akhir', [MahasiswaController::class, 'tugasAkhir'])->name('tugasAkhir');
    Route::get('/tugas-akhir-create', [MahasiswaController::class, 'tugasAkhirCreate'])->name('tugasAkhirCreate');
    Route::post('/tugas-akhir', [MahasiswaController::class, 'StoreTugasAkhir'])->name('StoreTugasAkhir');
    Route::put('/profile/update', [MahasiswaController::class, 'update'])->name('profileUpdate');
    Route::put('/passwordProdi/update', [MahasiswaController::class, 'updatePassword'])->name('passwordUpdateMahasiswa');
    Route::get('/konsultasi', [MahasiswaController::class, 'konsul'])->name('halamanKonsultasi');
    Route::get('/tgl_penting', [MahasiswaController::class, 'tgl_penting'])->name('halamanTanggal');
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
