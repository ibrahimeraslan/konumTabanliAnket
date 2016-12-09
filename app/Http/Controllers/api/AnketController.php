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

}
