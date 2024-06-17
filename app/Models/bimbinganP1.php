<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BimbinganP1 extends Model
{
    use HasFactory;

    protected $table = 'tb_bimbingan_p1';

    protected $fillable = [
        'pembimbing1_id',
        'tanggal',
        'tanggal_reschedule',
        'status',
    ];

    public function logbookB1()
    {
        return $this->hasMany(LogbookB1::class);
    }

    public function pembimbing1()
    {
        return $this->belongsTo(Pembimbing1::class);
    }
}
