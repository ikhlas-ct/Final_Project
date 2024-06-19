<?php

namespace App\Models;

use App\Models\Fakultas;
use App\Models\JudulFinal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        return $this->hashMany(JudulFinal::class);
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }
}
