<?php

namespace App\Models;

use App\Models\LogbookB2;
use App\Models\Pembimbing1;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function logbookB2()
    {
        return $this->hasMany(LogbookB2::class);
    }

    public function pembimbing1()
    {
        return $this->belongsTo(Pembimbing1::class);
    }
}
