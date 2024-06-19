<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\JudulFinal;
use App\Models\bimbinganP1;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembimbing1 extends Model
{
    use HasFactory;
    protected $table = 'tb_pembimbing1';
    protected $fillable = [
        'judul_final_id',
        'dosen_id',
        'status',
    ];

    public function bimbinganp1()
    {
        return $this->hasMany(bimbinganP1::class);
    }

    public function judulFInal()
    {
        return $this->belongsTo(JudulFinal::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
