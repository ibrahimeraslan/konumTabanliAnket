<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SSS extends Model
{
    protected $table = "sss";
    public $timestamps = false;
    protected $fillable = [
        'id', 'soru_metni','soru_cevabi', 'durum',
    ];
    protected $hidden = [
        'admin_sifre'
    ];
}
