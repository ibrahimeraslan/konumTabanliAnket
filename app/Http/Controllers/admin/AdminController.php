<?php

namespace App\Http\Controllers\admin;

use App\Anket;
use App\page\Iletisim;
use App\SistemAyar;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Redirect;
use Input;
use DB;

class AdminController extends Controller
{
    protected function index(){
        $anketVeren = User::where('tip',2)->count();
        $anketDolduran = User::where('tip',1)->count();
        $admin = User::where('is_admin',1)->count();
        $sonAnketler = Anket::join('users', 'users.id', '=', 'anketler.uye_id')
            ->orderBy('anketler.id','desc')->limit(10)

            ->get();
        return view('admin.index',['anketVeren'=>$anketVeren, 'anketDolduran'=>$anketDolduran, 'admin'=>$admin, 'sonAnketler'=>$sonAnketler]);
    }
    protected function sistemAyar(){
        return view('admin.sistemAyar');
    }
    protected function sistemAyarGuncelle(){
        $rules = array(
            'site_adi'  => 'required|min:3|max:250',
            'ucret_kesintisi' => 'required|numeric|min:0|max:100',
            'aktarim_siniri' => 'required|numeric',
            'site_mail' => 'required|email',
            'site_tel' => 'required',
            'site_adres' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()
                ->withErrors($validator);
        } else {
            SistemAyar::first()->update([
               'site_adi'=>Input::get('site_adi'),
               'ucret_kesintisi'=>Input::get('ucret_kesintisi'),
               'aktarim_siniri'=>Input::get('aktarim_siniri'),
               'site_mail'=>Input::get('site_mail'),
               'site_tel'=>Input::get('site_tel'),
               'site_adres'=>Input::get('site_adres'),
               'facebook'=>Input::get('facebook'),
               'twitter'=>Input::get('twitter'),
               'youtube'=>Input::get('youtube'),
            ]);
            return Redirect::back()->with('status','Cevap durumu başarıyla değiştirildi.');
        }
    }
    protected function butce(){
        $odeme = DB::table('para_aktarim_istekleri')->where('durum',2)->count();
        $anketSayisi = Anket::all()->count();
        $odemeToplam = DB::table('para_aktarim_istekleri')
            ->select(DB::raw('sum(miktar) as toplam'))
            ->where('durum', '=', 2)
            ->get();
        $odemeler = DB::table('para_aktarim_istekleri')->get();
        return view('admin.butce',['odeme'=>$odeme,'odemeToplam'=>json_decode(json_encode($odemeToplam,true)),'anketSayisi'=>$anketSayisi,'FunctionController'=>new FunctionController(),'odemeler'=>$odemeler]);
    }

}
