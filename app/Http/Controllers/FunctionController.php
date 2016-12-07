<?php

namespace App\Http\Controllers;

use App\Anket;
use App\DoldurulmusAnket;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class FunctionController extends Controller
{

    public static function secenekOlustur($tip,$id,$durum = null, $sayi = null){

            $cevaplar = DB::table('uyelik_soru_secenekleri')
                ->where('soru_id',$id)
                ->get();

        if($tip == 1){
            if(!empty($sayi) && $sayi != 0)
            $sonuc = "<select class='form-control' name='soru".($id*$sayi)."'>";
            else
            $sonuc = "<select class='form-control' name='soru".($id)."'>";
            foreach ($cevaplar as $cevap){
                if($durum=='1'){
                    $i = self::SecilmisMi(Auth::user()->id,$id,$cevap->id);
                    if($i == true)
                        $sonuc .= '<option selected value="'.$cevap->id.'">'.$cevap->cevap_metni.'</option>';
                    else
                        $sonuc .= '<option value="'.$cevap->id.'">'.$cevap->cevap_metni.'</option>';
                }
                else $sonuc .= '<option value="'.$cevap->id.'">'.$cevap->cevap_metni.'</option>';
            }
            $sonuc .= '</select>';
            return $sonuc;
        }else if($tip == 2){
            $sonuc = "";
            foreach ($cevaplar as $cevap){
                if($durum=='1') {
                    $i = self::SecilmisMi(Auth::user()->id, $id, $cevap->id);
                    if ($i == true)
                        $sonuc .= '<div class="anketRadio"><input checked type="radio" name="soru' . $id . '" value="' . $cevap->id . '" id="radioBtn' . $cevap->id . '"> <label for="radioBtn' . $cevap->id . '">' . $cevap->cevap_metni . '</label></div>';
                    else
                        $sonuc .= '<div class="anketRadio"><input type="radio" name="soru' . $id . '" value="' . $cevap->id . '" id="radioBtn' . $cevap->id . '"> <label for="radioBtn' . $cevap->id . '">' . $cevap->cevap_metni . '</label></div>';
                }
                else
                    if(!empty($sayi) && $sayi != 0)
                    $sonuc .= '<div class="anketRadio"><input type="radio" name="soru'.($id*$sayi).'" value="'.$cevap->id.'" id="radioBtn'.($cevap->id*$sayi).'"> <label for="radioBtn'.($cevap->id*$sayi).'">'.$cevap->cevap_metni.'</label></div>';
                    else
                    $sonuc .= '<div class="anketRadio"><input type="radio" name="soru'.$id.'" value="'.$cevap->id.'" id="radioBtn'.$cevap->id.'"> <label for="radioBtn'.$cevap->id.'">'.$cevap->cevap_metni.'</label></div>';
            }
            return $sonuc;
        }
    }
    public static function SecilmisMi($user_id,$soru_id,$cevap_id){
        $i = DB::table('uyelik_soru_cevaplari')->where('uye_id',$user_id)->where('soru_id',$soru_id)->where('cevap_id',$cevap_id)->first();
        if(count($i)<1)
            return false;
        else
            return true;
    }

    public static function anketDoldurSecenek($tip,$id,$durum = null, $sayi = null){
        $cevaplar = DB::table('anket_soru_secenekleri')
            ->where('soru_id',$id)
            ->get();
     //   iif(!DB::table('do'))
        if($tip==1){
            if($durum==1)
            $sonuc = "<select class='form-control' name='gsoru".($id)."'>";
            else
            $sonuc = "<select class='form-control' name='soru".($id)."'>";
            foreach ($cevaplar as $cevap){
                $sonuc .= '<option value="'.$cevap->id.'">'.$cevap->secenek_metni.'</option>';
            }
            $sonuc .= '</select>';
            return $sonuc;
        }else if($tip == 2){
            $sonuc = "";
            foreach ($cevaplar as $cevap){
                $sonuc .= ' <label>'.$cevap->secenek_metni.'</label> <input type="text" name="soru'.$id.'[]" class="form-control">';
            }
            return $sonuc;
        }else if($tip == 3){
            $sonuc = "";
            foreach ($cevaplar as $cevap){
                $sonuc .= ' <label>'.$cevap->secenek_metni.'</label> <textarea name="soru'.$id.'[]" value="'.$cevap->id.'" class="form-control"></textarea>';
            }
            return $sonuc;
        }else if($tip == 4){
            $sonuc = "";
            foreach ($cevaplar as $cevap){
                if($durum==1)
                $sonuc .= '<div class="anketRadio"><input type="radio" name="gsoru'.$id.'" value="'.$cevap->id.'" id="radioBtn'.$cevap->id.'"> <label for="radioBtn'.$cevap->id.'">'.$cevap->secenek_metni.'</label></div>';
                else
                $sonuc .= '<div class="anketRadio"><input type="radio" name="soru'.$id.'" value="'.$cevap->id.'" id="radioBtn'.$cevap->id.'"> <label for="radioBtn'.$cevap->id.'">'.$cevap->secenek_metni.'</label></div>';
            }
            return $sonuc;
        }else if($tip == 5){
            $sonuc = "";
            foreach ($cevaplar as $cevap){
                $sonuc .= '<div class="anketRadio"><input type="checkbox" name="soru'.$id.'[]" value="'.$cevap->id.'" id="radioBtn'.$cevap->id.'"> <label for="radioBtn'.$cevap->id.'">'.$cevap->secenek_metni.'</label></div>';
            }
            return $sonuc;
        }
    }
    public static function doldurmusMu($id){
        $d_id = DoldurulmusAnket::where('uye_id',Auth::user()->id)->where('anket_id',$id)->count();
        return $d_id;
    }
    public static function gizliSonuc($uye_id,$anket_id){
        $hata=0;
        $did = DoldurulmusAnket::where('uye_id',$uye_id)->where('anket_id',$anket_id)->first();
        $gizliSorular = DB::table('gizli_sorular')->where('ganket_id',$anket_id)->get();
      //
        if(!$gizliSorular) return -1;
        else{
            foreach ($gizliSorular as $gSoru){
                $dCevap = DB::table('doldurulmus_anket_cevaplari')->where('danket_id',$did->id)->where('soru_id',$gSoru->id)->first();
                $dCevap1 = DB::table('doldurulmus_anket_cevaplari')->where('danket_id',$did->id)->where('soru_id',$gSoru->soru_id)->first();
                if($dCevap->cevap_id != $dCevap1->cevap_id) $hata++;
            }
            if($hata==0) return 0; else return $hata;
        }
    }
    public static function cevaplar($dAnket, $u_id, $s_id, $tip){
        $return="";
        $sql = DB::table('doldurulmus_anket_cevaplari')->where('danket_id',$dAnket)->where('soru_id',$s_id)->get();
    foreach ($sql as $sq){
        if($sq->cevap_metni=="" && DB::table('anket_soru_secenekleri')->where('id',$sq->cevap_id)->count()<1)
            return "";
        if($tip==1 || $tip==4){
            $d = DB::table('anket_soru_secenekleri')->where('id',$sq->cevap_id)->first();
            $return .= "<b>".$d->secenek_metni."</b><br/>";
        }else if($tip==5){
            $d = DB::table('anket_soru_secenekleri')->where('id',$sq->cevap_metni)->first();
            $return .= "<b>".$d->secenek_metni."</b><br/>";
        }else{
                $return .= "<b>".$sq->cevap_metni."</b><br/>";
        }
    }
    return $return;
    }
}