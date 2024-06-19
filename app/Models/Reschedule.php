<?php

namespace App\Models;

use App\Models\Bimbingan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
