<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Sekolah extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'sekolah';
    protected $guard = 'sekolah';
    protected $guarded = [];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function get_kota($id)
    {
        $kota = Kota::where('id', $id)->first();
        return $kota->nama_kota;
    }
}