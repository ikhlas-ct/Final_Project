<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bimbinganP1 extends Model
{
    use HasFactory;
    protected $table = 'bimbingan_p1';
    protected $fillable = [
        'pembimbing_id',
        'tanggal',
        'status',
    ];

    public function pembimbing1()
    {
        return $this->belongsTo(User::class);
    }
}
