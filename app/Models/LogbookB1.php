<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogbookB1 extends Model
{
    use HasFactory;

    protected $table = 'tb_logbook_b1';

    protected $fillable = [
        'bimbingan_p1_id',
        'kegiatan',
        'detail_kegiatan',
    ];



    public function pembimbingP1()
    {
        return $this->belongsTo(PembimbingP1::class, 'pembimbing_p1_id');
    }
}
