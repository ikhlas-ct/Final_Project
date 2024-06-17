<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembimbing2 extends Model
{
    use HasFactory;
    protected $table = 'tb_pembimbing2';
    protected $fillable = [
        'judul_final_id',
        'dosen_id',
    ];


    public function bimbinganp2()
    {
        return $this->hasMany(BimbinganP2::class);
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
