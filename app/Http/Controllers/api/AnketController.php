<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Input;
use Response;
class AnketController extends Controller
{
    protected function katilinanAnketler(){
        $doldurulmusAnket = DB::table('doldurulmus_anketler')
            ->join('anketler', 'anketler.id', '=', 'doldurulmus_anketler.anket_id')
            ->where('doldurulmus_anketler.uye_id', '=', Input::get('id'))
            ->get();
        return Response::json( [
            'trpoll' => [
                'case' => 1,
                'message' => $doldurulmusAnket,
            ]
        ], 200);
    }
    protected function olusturduklarim(){
        $anketler = DB::table('anketler')->where('uye_id',Input::get('id'))->get();
        if($anketler){
            return Response::json( [
                'trpoll' => [
                    'case' => 1,
                    'message' => $anketler,
                ]
            ], 200);
        }
        else{
                return Response::json( [
                    'trpoll' => [
                        'case' => 0,
                        'message' => "Hatalı işlem",
                    ]
                ], 400);
        }
    }
    protected function katilabileceklerim(){
        if(!Input::get('konum')){
            return Response::json( [
                'trpoll' => [
                    'case' => 0,
                    'message' => "Konum Bilgisi Hatası",
                ]
            ], 400);
        }
        else{
            $sql="select DISTINCT anketler.id, anket_adi, anket_id, anket_durum, anket_katilim_sayisi,anket_limit,anket_ucret from uyelik_soru_cevaplari, anket_kurallari, anketler
        where uyelik_soru_cevaplari.uye_id=".Input::get('id')." 
        and anket_kurallari.soru_id=uyelik_soru_cevaplari.soru_id
        and anket_kurallari.cevap_id=uyelik_soru_cevaplari.cevap_id
        and anketler.anket_durum=1
        and anketler.anket_katilim_sayisi < anketler.anket_limit
        and
        (
            anketler.anket_konum=''
            or
            (
                anketler.anket_konum='" . Input::get('konum') . "'
            )
        ) order by anketler.id desc
        ";
            $veriler = DB::select(DB::raw($sql));
            if($veriler){
                return Response::json( [
                    'trpoll' => [
                        'case' => 1,
                        'message' => $veriler,
                    ]
                ], 200);
            }
            else{
                return Response::json( [
                    'trpoll' => [
                        'case' => 0,
                        'message' => "Sonuç Bulunamadı",
                    ]
                ], 400);
            }
        }
    }

}
