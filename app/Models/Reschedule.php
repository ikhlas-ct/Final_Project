<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reschedule extends Model
{
    use HasFactory;
    protected $table = 'tb_reschedule';
    protected $fillable = [
        'bimbingan_id',
        'tanggal',
    ];
    public function bimbingan()
    {
        return $this->belongsTo(Bimbingan::class);
    }
}
