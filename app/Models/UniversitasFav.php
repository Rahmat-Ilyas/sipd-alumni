<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class UniversitasFav extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'universitas_fav';
    protected $guarded = [];

    public function universitas()
    {
        return $this->belongsTo(Universitas::class);
    }

    public function get_siswa()
    {
        // return Siswa::where('universitas_id', $this->universitas_id)->get();
    }
}