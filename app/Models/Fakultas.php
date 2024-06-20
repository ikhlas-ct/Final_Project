<?php

namespace App\Models;

use App\Models\Tema;
use App\Models\Dosen;
use App\Models\Kaprodi;
use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fakultas extends Model
{
    use HasFactory;

    protected $table = 'tb_fakultas';
    
    protected $fillable = [
        'nama',
    ];

    public function dosen()
    {
        return $this->hasMany(Dosen::class, 'user_id');
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'user_id');
    }

    public function kaprodi()
    {
        return $this->hasMany(Kaprodi::class, 'user_id');
    }

    public function tema()
    {
        return $this->hasMany(Tema::class);
    }
}
