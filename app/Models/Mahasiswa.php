<?php

namespace App\Models;

use App\Models\User;
use App\Models\Fakultas;
use App\Models\Bimbingan;
use App\Models\Pengajuan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'tb_mahasiswa';
    
    protected $fillable = [
        'user_id',
        'fakultas_id', // Sesuaikan dengan nama kolom yang digunakan dalam migrasi
        'nama',
        'nim',
        'no_hp',
        'poto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'fakultas_id');
    }

    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class, 'mahasiswa_id');
    }
    public function bimbingan()
    {
        return $this->hasMany(Bimbingan::class);
    }
}