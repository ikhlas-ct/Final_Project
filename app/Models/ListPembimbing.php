<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\Pengajuan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListPembimbing extends Model
{
    use HasFactory;

    protected $table = 'tb_list_pembimbing';
    protected $fillable = [
        'dosen_id',
        'pengajuan_id',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id');
    }
}
