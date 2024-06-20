<?php

namespace App\Models;

use App\Models\Pembimbing2;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        return $this->belongsTo(Pembimbing2::class);
    }
}