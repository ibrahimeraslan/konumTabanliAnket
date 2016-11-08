<?php

namespace App\Http\Controllers;

use App\UyelikSoru;
use Illuminate\Http\Request;
use Auth;
use Input;
use DB;
use Illuminate\Support\Facades\Redirect;
class PanelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function durumKontrol(){
        if(Auth::user()->durum == 0){

            $users = DB::table('uyelik_sorulari')
                ->join('uyelik_soru_secenekleri', 'uyelik_sorulari.id', '=', 'uyelik_soru_secenekleri.soru_id')
                ->where('uyelik_sorulari.tip',Auth::user()->tip)
                ->get();

            return view('panel.bilgiDoldur',['FunctionController' => new FunctionController ,'sorular'=> $users]);
        }
        else return view('panel.panel');
    }

    protected function tipDegistir(){
        if(Auth::user()->tip != 0){
            return Redirect::to('/kullanici/panel')
                ->withErrors("Bu işlemi yapmaya yetkiniz yok.");
        }
        else{
            $user = Auth::user();
            $user->tip= Input::get('tip');
            $user->update();
            return Redirect::to('/kullanici/panel');
        }
    }

}
