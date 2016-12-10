<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnketSoru extends Model
{
    protected $table = "anket_sorulari";

    protected $fillable = [
        'id', 'anket_id', 'soru_metni', 'tip'
    ];

    protected $hidden = [

    ];
}
