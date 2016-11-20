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
}
