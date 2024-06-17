<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BimbinganP2 extends Model
{
    use HasFactory;

    protected $table = 'tb_bimbingan_p2';

    protected $fillable = [
        'pembimbing2_id',
        'tanggal',
        'tanggal_reschedule',
        'status',
    ];

    public function pembimbing1()
    {
        return $this->belongsTo(Pembimbing1::class);
    }
}
