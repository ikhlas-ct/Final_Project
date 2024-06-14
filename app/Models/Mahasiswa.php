<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function pembimbing()
    {
        return $this->belongsToMany(Dosen::class, 'mahasiswa_bimbingan', 'mahasiswa_id', 'dosen_id');
    }

    public function logbooks()
    {
        return $this->hasMany(Logbook::class);
    }
}
