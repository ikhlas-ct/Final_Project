<?php

namespace App\Models;

use App\Models\JudulFinal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'tb_pengajuan';
    protected $fillable = [
        'mahasiswa_id',
        'tema_id',
        'judul',
        'proposal',
        'status'
    ];

    public function judulFinal()
    {
        return $this->hasOne(JudulFinal::class);
    }

    public function listPembimbing()
    {
        return $this->hasMany(ListPembimbing::class);
    }

    public function statusPengajuan()
    {
        return $this->hasMany(StatusPengajuan::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function Tema()
    {
        return $this->belongsTo(Tema::class);
    }
}
