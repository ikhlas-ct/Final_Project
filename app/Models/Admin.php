<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Model
{
    use HasFactory;
    protected $table = 'admin';
    protected $fillable = [
        'user_id', 
        'gambar',
        'nama', 
        'no_hp', 
        'alamat', 
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
