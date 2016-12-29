<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UyelikSoru extends Model
{
    protected $table = 'uyelik_sorulari';
    public $timestamps = false;
    protected $fillable = [
        'id', 'soru_metni', 'soru_tip', 'tip',
    ];
}
