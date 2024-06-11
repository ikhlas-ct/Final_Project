<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Judul extends Model
{
    use HasFactory;

    protected $table = 'tb_judul';
    protected $fillable = [
        'pengajuan_id',
        'tema_id',
        'judul',
        'file',
        'status'
    ];

    public function Pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }

    public function Tema()
    {
        return $this->belongsTo(Tema::class);
    }
}
