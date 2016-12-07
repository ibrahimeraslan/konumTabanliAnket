<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anket extends Model
{
    protected $table = "anketler";

    protected $fillable = [
        'id', 'uye_id', 'anket_adi', 'anket_konum', 'anket_limit', 'anket_katilim_sayisi', 'anket_ucret', 'anket_durum', 'anket_sayfa_sayisi',
    ];

    protected $hidden = [

    ];
}
