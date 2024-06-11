<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa';

    protected $fillable = [
        'user_id', 
        'gambar',
        'nama', 
        'nim', 
        'fakultas', 
        'no_hp', 
        'alamat', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dosenPembimbing()
    {
        return $this->hasManyThrough(dosen_pembimbing::class, MahasiswaBimbingan::class, 'mahasiswa_id', 'id', 'id', 'bimbingan_id');
    }

    public function mahasiswaBimbingan()
    {
        return $this->hasMany(MahasiswaBimbingan::class, 'mahasiswa_id');
    }




}
