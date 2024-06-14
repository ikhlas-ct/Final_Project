<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'tb_dosen';

    protected $fillable = [
        'user_id',
        'fakultas_id',
        'nama',
        'nidn',
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

    public function mahasiswaBimbingan()
    {
        return $this->belongsToMany(Mahasiswa::class, 'mahasiswa_bimbingan', 'dosen_id', 'mahasiswa_id');
    }
}
