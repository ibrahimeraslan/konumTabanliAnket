<?php

namespace App\Http\Controllers\admin;

use App\page\Iletisim;
use App\SistemAyar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Redirect;
use Input;

class AdminController extends Controller
{
    protected function index(){
        return view('admin.index');
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
        return view('admin.butce');
    }

}
