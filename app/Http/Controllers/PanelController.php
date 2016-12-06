<?php

namespace App\Http\Controllers;

use App\User;
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
            if(Auth::user()->tip==1) {
                //üyelik sorularını doldurmuş ise!
                $doldurulmusAnket = DB::table('doldurulmus_anketler')
                    ->join('anketler', 'anketler.id', '=', 'doldurulmus_anketler.anket_id')
                    ->where('doldurulmus_anketler.uye_id', '=', Auth::user()->id)
                    ->get();
                $aktifAnket = DB::table('anketler')->whereRaw('anket_durum=1 and anket_katilim_sayisi < anket_limit')->count();
                $toplamPara = DB::select(DB::raw('select sum(miktar) as toplam from para_aktarim_istekleri where user_id='.Auth::user()->id.' and durum=2'));
                $pIstekler = DB::table('para_aktarim_istekleri')->where('user_id',Auth::user()->id)->get();
                return view('panel.panel', ['tip'=>1,'dAnketler' => $doldurulmusAnket, 'aktifAnket' => $aktifAnket, 'toplamPara' => $toplamPara, 'pIstekler'=>$pIstekler]);
            }
            elseif(Auth::user()->tip==2){
                $anketler = DB::table('anketler')->where('uye_id',Auth::user()->id)->get();
                $uyeSayisi = User::where('tip',1)->count();
                $uyeASayisi = User::where('tip',2)->count();
                $toplamKatilim = DB::table('doldurulmus_anketler')
                    ->join('anketler', 'anketler.id', '=', 'doldurulmus_anketler.anket_id')
                    ->where('anketler.uye_id', '=', Auth::user()->id)
                    ->count();
                return view('panel.panel', ['tip'=>2, 'anketler'=>$anketler, 'uyeSayisi'=>$uyeSayisi, 'uyeASayisi'=>$uyeASayisi, 'toplamKatilim'=>$toplamKatilim]);
            }
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
        $sql="select DISTINCT anketler.id, anket_adi, anket_id, anket_durum, anket_katilim_sayisi,anket_limit,anket_ucret from uyelik_soru_cevaplari, anket_kurallari, anketler
        where uyelik_soru_cevaplari.uye_id=".Auth::user()->id." 
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
       return view('panel.anketler',['FunctionController'=>new FunctionController(),'veriler'=>$veriler]);
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
    protected function bilgiGuncelle(){
        $cevap = DB::table('uyelik_sorulari')
            ->where('tip',Auth::user()->tip)
            ->get();
        foreach ($cevap as $list) {
            if (!Input::get('soru' . $list->id)) {
                return Redirect::to('/kullanici/ayarlar')->withErrors('Lütfen tüm soruları cevaplandırınız.');
            }
        }
        foreach ($cevap as $list){

            $cevap = DB::table('uyelik_soru_cevaplari')->where('uye_id',Auth::user()->id)->where('soru_id',$list->id)->update([
                'cevap_id' => Input::get('soru'.$list->id)
            ]);

        }
        return Redirect::to('/kullanici/ayarlar')->with('status','Cevaplarınız başarı ile kaydedildi.');
    }
}
