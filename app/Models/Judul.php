<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Judul extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengajuan_id',
        'judul',
        'konsentrasi',
        'file',
        'status'
    ];

    public function Pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
}
