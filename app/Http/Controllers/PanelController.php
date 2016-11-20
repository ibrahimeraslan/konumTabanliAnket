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
                ->where('tip',Auth::user()->tip)
                ->get();

            return view('panel.bilgiDoldur',['FunctionController' => new FunctionController ,'sorular'=> $users]);
        }
        else {
            //üyelik sorularını doldurmuş ise!
            $doldurulmusAnket = DB::table('doldurulmus_anketler')
                ->join('anketler', 'anketler.id', '=', 'doldurulmus_anketler.anket_id')
                ->where('doldurulmus_anketler.uye_id', '=', Auth::user()->id)
                ->get();
            $aktifAnket = DB::table('anketler')->whereRaw('anket_durum=1 and anket_katilim_sayisi < anket_limit')->count();
            return view('panel.panel',['dAnketler'=>$doldurulmusAnket,'aktifAnket'=>$aktifAnket]);
        }
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
    protected function anketGetir(){

        return Input::get("konum");
    }

    protected function uyelikCevaplariIsle(){
        $cevap = DB::table('uyelik_sorulari')
            ->where('tip',Auth::user()->tip)
            ->get();
        foreach ($cevap as $list) {
            if (!Input::get('soru' . $list->id)) {
                return Redirect::to('/kullanici/panel')->withErrors('Lütfen tüm soruları cevaplandırınız.');
            }
        }
        foreach ($cevap as $list){

                $cevap = DB::table('uyelik_soru_cevaplari')->insert([
                            ['uye_id' => Auth::user()->id, 'soru_id' => $list->id,'cevap_id' => Input::get('soru'.$list->id)]
                        ]);

        }
        $user = Auth::user();
        $user->durum = 1;
        $user->update();
        return Redirect::to('/kullanici/panel')->with('status','Cevaplarınız başarı ile kaydedildi.');
    }
}
