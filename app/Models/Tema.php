<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    use HasFactory;

    protected $table = 'tb_tema';
    protected $fillable = [
        'fakultas_id',
        'nama',
    ];


    public function pengajuan()
    {
        return $this->hashMany(Judul::class);
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }
}
