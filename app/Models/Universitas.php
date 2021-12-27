<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Universitas extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'universitas';
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

    public function get_uniq() {
        $univ = $this->all();
        $result = [];
        foreach ($univ as $dta) {
            $fav = UniversitasFav::where('universitas_id', $dta->id)->first();
            if (!$fav) {
                $result[] = $dta;
            }
        }
        return $result;
    }
}