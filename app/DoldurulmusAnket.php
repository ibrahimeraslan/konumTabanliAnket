<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoldurulmusAnket extends Model
{
    protected $table = "doldurulmus_anketler";

    protected $fillable = [
        'id','anket_id', 'uye_id', 'durum','created_at'
    ];

    protected $hidden = [

    ];
}
