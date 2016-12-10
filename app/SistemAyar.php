<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SistemAyar extends Model
{
    protected $table = "sistem_ayarlari";
    public $timestamps = false;
    protected $fillable = [
        'id', 'site_adi','ucret_kesintisi', 'aktarim_siniri', 'site_mail','site_tel', 'site_adres','facebook','twitter','youtube',
    ];

    protected $hidden = [
    ];
}
