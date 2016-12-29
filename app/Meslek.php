<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meslek extends Model
{
    protected $table = "meslekler";
    public $timestamps = false;
    protected $fillable = [
        'id', 'meslek_adi',
    ];

    protected $hidden = [

    ];
}
