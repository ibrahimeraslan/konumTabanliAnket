<?php

namespace App\page;

use Illuminate\Database\Eloquent\Model;

class SistemSayfa extends Model
{
    protected $table = "sistem_sayfalari";

    protected $fillable = [
        'id', 'sayfa_adi', 'sayfa_metni',
    ];

    protected $hidden = [

    ];
}
