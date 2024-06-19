<?php

namespace App\Models;

use App\Models\User;
use App\Models\Fakultas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kaprodi extends Model
{
    use HasFactory;

    protected $table = 'tb_kaprodi';
    protected $fillable = [
        'user_id',
        'fakultas_id',
        'nama',
        'nidn',
        'no_hp',
        'poto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }
}
