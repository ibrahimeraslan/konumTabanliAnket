<?php

namespace App\Http\Controllers\anket;

use App\AnketSoru;
use App\DoldurulmusAnket;
use App\Http\Controllers\FunctionController;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Redirect;
use Input;
use Validator;
use Auth;
use App\Anket;

class AnketController extends Controller
{
    protected function index($id){
        if(FunctionController::doldurmusMu($id)>0) return Redirect::to('kullanici/panel')->withErrors('Bu anketi zaten doldurmuşsunuz.');
        $anket = Anket::where('id',$id)->where('anket_katilim_sayisi','<',Anket::where('id',$id)->first()->anket_limit)->first();
        if(!$anket) return Redirect::to('kullanici/panel')->withErrors('Ankete Katılım Limiti Dolmuştur.');
        $sorular = AnketSoru::where('anket_id',$anket->id)->get();
        $gizliSorular = DB::table("gizli_sorular")->where('ganket_id',$id)
            ->join('anket_sorulari','anket_sorulari.id','gizli_sorular.soru_id')->get();
        return view('anketStart',['anket'=>$anket,'sorular'=>$sorular,'FunctionController'=>new FunctionController(),'id'=>$id,'gizliSorular'=>$gizliSorular]);
    }
    protected function anketCevabiEkle($id)
    {
        if(FunctionController::doldurmusMu($id)>0) return Redirect::to('kullanici/panel')->withErrors('Bu anketi zaten doldurmuşsunuz.');
        $anket = Anket::where('id', $id);
        if (!$anket) {
            return Redirect::to('kullanici/start/' . $id)->withErrors('Hatalı işlem');
        } else {
            $hata = 0;
            $anketSorular = AnketSoru::where('anket_id', $id)->get();
            foreach ($anketSorular as $anketSoru) {
                if ($anketSoru->tip == 1 || $anketSoru->tip == 4) {
                    if (!Input::get('soru' . $anketSoru->id)) $hata = 1;
                } elseif ($anketSoru->tip == 2 || $anketSoru->tip == 3 || $anketSoru->tip == 5) {
                    foreach (Input::get('soru' . $anketSoru->id) as $cevap) {
                        if (!$cevap) $hata = 1;
                    }
                }
            }
            $gSorular = DB::table('gizli_sorular')->where('ganket_id',$id)->get();
            foreach ($gSorular as $gSoru){
                if (!Input::get('gsoru' . $gSoru->soru_id)) $hata = 1;
            }
            if ($hata == 1)
                return Redirect::to('kullanici/start/' . $id)->withErrors('Lütfen tüm soruları cevaplayınız.');
            else {
                $aEkle = DoldurulmusAnket::create([
                   'uye_id' => Auth::user()->id,
                    'anket_id'=>$id,
                    'durum'=>0
                ]);
                if($aEkle){
                    $anketSorular = AnketSoru::where('anket_id', $id)->get();
                    foreach ($anketSorular as $anketSoru) {
                        if ($anketSoru->tip == 1 || $anketSoru->tip == 4) {
                            DB::table('doldurulmus_anket_cevaplari')->insert([
                               'danket_id'=> $aEkle->id,
                                'soru_id'=>$anketSoru->id,
                                'cevap_id'=>Input::get('soru' . $anketSoru->id),
                                'cevap_metni'=>"",
                                'soru_tip'=>0
                            ]);
                            if (!Input::get('soru' . $anketSoru->id)) $hata = 1;
                        } elseif ($anketSoru->tip == 2 || $anketSoru->tip == 3 || $anketSoru->tip == 5) {
                            foreach (Input::get('soru' . $anketSoru->id) as $cevap) {
                                DB::table('doldurulmus_anket_cevaplari')->insert([
                                    'danket_id'=> $aEkle->id,
                                    'soru_id'=>$anketSoru->id,
                                    'cevap_id'=>0,
                                    'cevap_metni'=>$cevap,
                                    'soru_tip'=>0
                                ]);
                            }
                        }
                    }
                    $gSorularr = DB::table('gizli_sorular')->where('ganket_id',$id)->get();
                    foreach ($gSorularr as $gisoru){
                        DB::table('doldurulmus_anket_cevaplari')->insert([
                            'danket_id'=> $aEkle->id,
                            'soru_id'=>$gisoru->id,
                            'cevap_id'=>Input::get('gsoru' . $gisoru->soru_id),
                            'cevap_metni'=>"",
                            'soru_tip'=>1
                        ]);
                    }
                    Anket::where('id',$id)->increment('anket_katilim_sayisi');
                    return Redirect::to('kullanici/panel')->with('status','Anketi Başarı İle Doldurdunuz. Gerekli Kontrollerden Sonra Ücret Hesabınıza Eklenecektir.');
                }
            }
        }
    }
    protected function anketDurumu($durum,$id){
        DB::table('anketler')->where('id',$id)->update([
            'anket_durum' => $durum
        ]);
        return Redirect::to('/kullanici/panel');
    }
    protected function anketOlustur(){
        return view('anket.new');
    }
    protected function kuralIslemleri(){
        if(Input::get('islem')==1){
            $sayi = Input::get('sayi');
            $sonuc = "<div class='alert alert-info' id='kuralSoruSecenekList$sayi'><select id='kuralSoruSecenek$sayi' name='kuralSoruSecenek[$sayi]' onchange='kuralSectim(".$sayi.")' class='form-control kuralSoruSecenekList'>";
            $sorular = DB::table('uyelik_sorulari')->where('tip',1)->get();
            $sonuc .= "<option value='0'>Lütfen Seçiniz</option>";
            foreach ($sorular as $soru){
                $sonuc .= "<option value='".$soru->id."'>".$soru->soru_metni."</option>";
            }
            $sonuc .="</select><div id='kuralSecenek$sayi'></div>";
            return $sonuc;
        } elseif (Input::get('islem')==2){
            if(Input::get('soru')==0) return "";
            $anket = DB::table("uyelik_sorulari")->where('id',Input::get('soru'))->first();
            return FunctionController::secenekOlustur($anket->soru_tip,Input::get('soru'),0,Input::get('sayi'));
        }
    }
    protected function anketIsle(){
        $rules = array(
            'anket_isim'  => 'required|max:150|min:5',
            'anket_kisi' => 'required|numeric|min:1|max:1000000',
            'anket_ucret'  => 'required|min:0.1',
            'anket_sayfa_sayisi'  => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::to('kullanici/anketOlustur')
                ->withErrors($validator);

        } else {
            $aanketEkle = Anket::create([
                'uye_id' => Auth::user()->id,
                'anket_adi' => Input::get('anket_isim'),
                'anket_konum' => Input::get('anket_konum'),
                'anket_limit' => Input::get('anket_kisi'),
                'anket_ucret' => Input::get('anket_ucret'),
                'anket_sayfa_sayisi' => Input::get('anket_sayfa_sayisi'),
                'anket_durum' => 1
            ]);
            if($aanketEkle){
                if(Input::get('kuralDurumu')==1){
                    $sayi=0;
                    foreach (Input::get('kuralSoruSecenek') as $secenek)
                    {
                        $sayi++;
                        if(Input::get('soru'.($secenek*$sayi))){
                            DB::table("anket_kurallari")->insert([
                                'anket_id' =>$aanketEkle->id,
                                'soru_id'=>$secenek,
                                'cevap_id'=>Input::get('soru'.($secenek*$sayi))
                          ]);
                         }
                    }
                }
                $cik =0; $kac=0;
                while($cik!=1){
                    $kac++;
                    if(Input::get('yeniSoru'.$kac)){
                       $soruEkle= AnketSoru::create([
                            'anket_id' =>$aanketEkle->id,
                            'soru_metni'=>Input::get('yeniSoru'.$kac),
                            'tip'=>Input::get('soruTip'.$kac)
                        ]);
                        if($soruEkle){
                            foreach (Input::get('secenek'.$kac) as $secenek){
                                $soruSecenekEkle= DB::table("anket_soru_secenekleri")->insert([
                                    'soru_id' =>$soruEkle->id,
                                    'secenek_metni'=>$secenek,
                                ]);
                            }
                        }


                    }else break;
                }
            }

            return Redirect::to('kullanici/panel')->with('status','Anketiniz başarıyla oluşturularak yayına geçirilmiştir.');
        }

    }
    protected function gizliSoru($id){
        $anket = Anket::where('id',$id)->first();
        $egSoru = DB::table('anket_sorulari')->where('anket_id',$id)
            ->join('gizli_sorular','gizli_sorular.soru_id','=','anket_sorulari.id')->get();
        $sorular = AnketSoru::where('anket_id',$id)->where('tip',1)->orWhere('tip',4)->where('anket_id',$id)->get();
        return view('anket.gizliSoru',['anket'=>$anket, 'egSoru'=>$egSoru, 'sorular'=>$sorular]);
    }
    protected function gizliSoruEkle($id){
        $rules = array(
            'soru'  => 'required',
            'gSoru' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::to('kullanici/panel')
                ->withErrors($validator);
        } else {
            DB::table("gizli_sorular")->insert([
                'ganket_id'=>$id,
                'soru_id'=>Input::get('soru'),
                'gizli_soru_metni'=>Input::get('gSoru'),
            ]);
            return Redirect::to('kullanici/panel')->with('status','Gizli soru başarıyla eklendi.');
        }
    }
    protected function gizliSoruSil($id){
        DB::table("gizli_sorular")->where('id',$id)->delete();
        return Redirect::to('kullanici/panel')->with('status','Gizli soru başarıyla silindi.');
    }
    protected function cevapGoster($id){
        $anket=Anket::where('id',$id)->first();
        $dAnket = DoldurulmusAnket::select(array('users.id', 'doldurulmus_anketler.id AS did', 'users.name', 'doldurulmus_anketler.created_at','doldurulmus_anketler.durum','users.avatar'))->where('anket_id',$id)
            ->join('users','users.id','doldurulmus_anketler.uye_id')
            ->get();
        if(count($dAnket)>0){
            $anketCevaplari = DB::table('doldurulmus_anket_cevaplari')->where('danket_id',$dAnket[0]->id)->get();
        }
        else{
            $anketCevaplari="";
        }
        return view('panel.cevaplar',['anket'=>$anket,'dAnket'=>$dAnket, 'anketCevaplari'=>$anketCevaplari, 'FunctionController'=>new FunctionController(),'aid'=>$id]);
    }
    protected function cevapDurumla(){
        if(DB::table('doldurulmus_anketler')->where('id',Input::get('cAnket'))->update(['durum'=>Input::get('cDurum')]))
            return Redirect::back()->with('status','Cevap durumu başarıyla değiştirildi.');
        else return Redirect::back()->withErrors('Hatalı işlem.');
    }

    protected function cevapListele(){
        $uye = User::where('id',Input::get('dKisi'))->first();
        $sorular = AnketSoru::where('anket_id',Input::get('anketId'))->get();

        return view('anket.cevapListesi',['sorular'=>$sorular, 'uye'=>$uye,'dAnket'=>Input::get('dAnket'), 'FunctionController'=>new FunctionController()]);
    }
    protected function anketBilgiDuzenle($id){
        $anket = Anket::where('id',$id)->first();
        $anketSorulari = AnketSoru::where('anket_id',$anket->id)->get();
        return view('anket.anketDuzenleBilgi',['anket'=>$anket,'anketSorulari'=>$anketSorulari,'id'=>$id]);
    }
    protected function soruDuzenle(){
        $don = DB::table("anket_soru_secenekleri")->where('soru_id',Input::get('soru'))->get();
        $sonuc="";
        foreach ($don as $d){
            $sonuc.="<div class='secenekSil".$d->id."'><div class='col-md-1'><button data-id='".$d->id."' class='secenekSilBtn btn btn-danger btn-xs'><i class='fa fa-remove'></i> Sil</button></div><div class='col-md-11'><input name='duzenle".$d->id."' type='text' class='form-control' value='".$d->secenek_metni."'></div></div>";
        }
        $sonuc.="<div id='yeniSecenek'><button onclick='yeniEkle()' class='btn btn-primary btn-sm'><i class='fa fa-plus'></i> Ekle</button></div>";
        return $sonuc;
    }
    protected function soruSecenekSil(){
        $sil = DB::table("anket_soru_secenekleri")->where('id',Input::get('id'))->delete();
        if($sil) return "Seçenek Başarıyla Silindi";
        else return "Hata Oluştu.";
    }
    protected function anketBilgiGuncelle($id){
        $rules = array(
            'anket_isim'  => 'required|max:150|min:5',
            'anket_sayfa_sayisi'  => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::to('kullanici/anket/anketBilgiDuzenle/'.$id)
                ->withErrors($validator);

        } else {
            $aanketEkle = Anket::where('id',$id)->update([
                'anket_adi' => Input::get('anket_isim'),
                'anket_konum' => Input::get('anket_konum'),
                'anket_sayfa_sayisi' => Input::get('anket_sayfa_sayisi'),
            ]);
            if ($aanketEkle) {
                if(Input::get('soru')){
                    $secenekler = DB::table('anket_soru_secenekleri')->where('soru_id',Input::get('soru'))->get();
                    foreach ($secenekler as $secenek){
                        if(Input::get('duzenle'.$secenek->id)){
                            DB::table('anket_soru_secenekleri')->where('id',$secenek->id)->update(['secenek_metni'=>Input::get('duzenle'.$secenek->id)]);
                        }
                    }
                    if(Input::get('bunuEkle')){
                        DB::table('anket_soru_secenekleri')->insert(['soru_id'=>Input::get('soru'),'secenek_metni'=>Input::get('bunuEkle')]);
                    }
                }

            }
            return Redirect::back()->with('status','Değişiklikler Başarıyla Kaydedildi');
        }
    }
    protected function paraTransfer(){
        $rules = array(
            'miktar'  => 'required|max:500|min:5|numeric',
            'tip'  => 'required|numeric|max:1',
            'isim'  => 'required|max:150',
            'bilgi'  => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()
                ->withErrors($validator);
        } else {
            DB::table('para_aktarim_istekleri')->insert([
                'user_id'=>Auth::user()->id,
                'miktar'=>Input::get('miktar'),
                'tip'=>Input::get('tip'),
                'isim'=>Input::get('isim'),
                'bilgi'=>Input::get('bilgi'),
                'mesaj'=>"",
                'durum'=>0
            ]);
            return Redirect::back()->with('status','İşleminiz başarıyla gerçekleşti. Aktarım durumunu hesabınızdan takip edebilirsiniz.');
        }
    }
    protected function ayrintiGoster($id){
        $anket = Anket::where('id',$id)->first();
        return view('anket.ayrintiGoster',['anket'=>$anket]);
    }
}
