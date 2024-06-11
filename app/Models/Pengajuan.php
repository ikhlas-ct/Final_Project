<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'tb_pengajuan';
    protected $fillable = [
        'mahasiswa_id',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function judul()
    {
        return $this->hasMany(Judul::class);
    }

    public function listPembimbing()
    {
        return $this->hasMany(ListPembimbing::class);
    }
}
