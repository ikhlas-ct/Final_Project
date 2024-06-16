<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bimbingan extends Model
{
    use HasFactory;

    protected $table = 'tb_bimbingan';

    protected $fillable = [
        'dosen_id',
        'mahasiswa_id',
        'tanggal',
        'tanggal_reschedule',
        'status',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
