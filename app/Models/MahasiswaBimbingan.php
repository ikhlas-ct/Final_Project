<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaBimbingan extends Model
{
    use HasFactory;

    protected $fillable = [
        'mahasiswa_id',
        'bimbingan_id',
        'status'
    ];

    public function judulTugasAkhir()
    {
        return $this->hasMany(JudulTugasAkhir::class);
    }
}
