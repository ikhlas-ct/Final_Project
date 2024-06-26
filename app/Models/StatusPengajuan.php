<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\Pengajuan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusPengajuan extends Model
{
    use HasFactory;

    protected $table = 'tb_status_pengajuan';

    protected $fillable = [
        'pengajuan_id',
        'dosen_id',
        'status',
        'keterangan',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
}