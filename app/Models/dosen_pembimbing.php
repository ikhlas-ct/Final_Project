<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen_Pembimbing extends Model
{
    protected $table = 'dosen_pembimbing';
    use HasFactory;
    protected $fillable = [
        'dosen_id',
        'jenis_dosbing',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }

    public function mahasiswaBimbingan()
    {
        return $this->hasMany(MahasiswaBimbingan::class, 'dosen_pembimbing_id');
    }

}

    