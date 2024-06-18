<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JudulFinal extends Model
{
    use HasFactory;

    protected $table = 'tb_judul_final';
    protected $fillable = [
        'pengajuan_id',
    ];

    public function Pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }

    public function pembimbing1()
    {
        return $this->hasOne(Pembimbing1::class);
    }

    public function pembimbing2()
    {
        return $this->hasOne(Pembimbing2::class);
    }
}
