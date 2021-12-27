<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'kota';
    protected $guarded = [];
}