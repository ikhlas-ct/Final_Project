<?php

namespace App\Models;

use App\Models\Pembimbing1;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        return $this->belongsTo(Pembimbing1::class);
    }
}
