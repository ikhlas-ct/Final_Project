<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Kaprodi;
use App\Models\Mahasiswa;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users'; // Sesuaikan dengan nama tabel yang benar

    protected $fillable = [
        'username',
        'password',
        'role',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function dosen()
    {
        return $this->hasOne(Dosen::class, 'user_id'); // Sesuaikan dengan foreign key yang digunakan di tabel Dosen
    }

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'user_id'); // Sesuaikan dengan foreign key yang digunakan di tabel Mahasiswa
    }
    
    public function kaprodi()
    {
        return $this->hasOne(Kaprodi::class, 'user_id'); // Sesuaikan dengan foreign key yang digunakan di tabel Prodi
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'user_id'); // Sesuaikan dengan foreign key yang digunakan di tabel Admin
    }
}