<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaBimbingan extends Model
{
    protected $table = 'mahasiswa_bimbingan';
    use HasFactory;

    protected $fillable = [
        'mahasiswa_id',
        'dosen_pembimbing_id',
        'status'
    ];
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
    public function dosenPembimbing()
    {
        return $this->belongsTo(dosen_pembimbing::class, 'dosen_pembimbing_id');
    }
    public function judulTugasAkhir()
    {
        return $this->hasMany(JudulTugasAkhir::class);
    }


}
