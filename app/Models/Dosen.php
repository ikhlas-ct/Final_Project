<?php

namespace App\Models;

use App\Models\User;
use App\Models\Fakultas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function pembimbing1()
    {
        return $this->hasMany(Pembimbing1::class);
    }

    public function pembimbing2()
    {
        return $this->hasMany(Pembimbing2::class);
    }

    public function statusPengajuan()
    {
        return $this->hasMany(StatusPengajuan::class);
    }
}