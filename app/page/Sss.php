<?php

namespace App\page;

use Illuminate\Database\Eloquent\Model;

class Sss extends Model
{
    protected $table = "sss";

    protected $fillable = [
        'id', 'soru_metni', 'soru_cevabi',
    ];

    protected $hidden = [

    ];
}
