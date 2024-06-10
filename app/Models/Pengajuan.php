<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'mahasiswa_id',
    ];

    public function Judul()
    {
        return $this->hasMany(Judul::class);
    }
}
