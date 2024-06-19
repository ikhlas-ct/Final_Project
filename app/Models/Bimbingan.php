<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
