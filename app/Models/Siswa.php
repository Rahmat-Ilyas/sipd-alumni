<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'siswa';
    protected $guarded = [];

    public function sekolah() 
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function universitas() 
    {
        return $this->belongsTo(Universitas::class);
    }
}