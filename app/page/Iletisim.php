<?php

namespace App\page;

use Illuminate\Database\Eloquent\Model;

class Iletisim extends Model
{
    protected $table = "iletisim";

    protected $fillable = [
        'id', 'isim', 'mail','konu','mesaj','durum','created_at',
    ];

    protected $hidden = [

    ];
}
