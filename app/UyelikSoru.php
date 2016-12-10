<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UyelikSoru extends Model
{
    protected $table = 'uyelik_sorulari';

    protected $fillable = [
        'id', 'soru_metni', 'tip',
    ];
}
