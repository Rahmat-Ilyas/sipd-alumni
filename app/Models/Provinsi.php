<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'provinsi';
    protected $guarded = [];

    public function get_kota($id)
    {
        $kota = Kota::where('provinsi_id', $id)->get();
        return $kota;
    }
}