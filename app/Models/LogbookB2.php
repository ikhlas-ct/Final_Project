<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogbookB2 extends Model
{
    use HasFactory;

    protected $table = 'tb_logbook_b2';

    protected $fillable = [
        'bimbingan_p2_id',
        'kegiatan',
        'detail_kegiatan',
    ];

    public function pembimbingP2()
    {
        return $this->belongsTo(PembimbingP2::class);
    }
}
