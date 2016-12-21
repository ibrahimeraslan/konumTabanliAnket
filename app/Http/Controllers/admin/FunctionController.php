<?php

namespace App\Http\Controllers\admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class FunctionController extends Controller
{
    public static function uyeBilgiIsim($id){
        return User::where('id',$id)->first()->name;
    }
    public static function soruSecenekleri($id){
        $secenekler = DB::table('uyelik_soru_secenekleri')->where('soru_id',$id)->get();
        $string="";
        foreach ($secenekler as $secenek){
            $string.='<b>'.$secenek->cevap_metni.'</b><br/>';
        }
        return $string;
    }
}
