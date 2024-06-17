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
<<<<<<< HEAD
    public function bimbingan()
    {
        return $this->hasMany(Bimbingan::class);
=======

    public function pembimbing()
    {
        return $this->belongsToMany(Dosen::class, 'mahasiswa_bimbingan', 'mahasiswa_id', 'dosen_id');
    }

    public function logbooks()
    {
        return $this->hasMany(Logbook::class);
>>>>>>> 0664a5bd655f13a9a97e5a4e4b00d4800a4467de
    }
}
