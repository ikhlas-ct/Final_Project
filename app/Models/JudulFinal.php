<?php

namespace App\Models;

use App\Models\Pengajuan;
use App\Models\Pembimbing1;
use App\Models\Pembimbing2;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
