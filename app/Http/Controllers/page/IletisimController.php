<?php

namespace App\Http\Controllers\page;

use App\page\Iletisim;
use App\SistemAyar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Input;
use Redirect;

class IletisimController extends Controller
{
    protected function index(){
        return view('page\iletisim');
    }
    protected function kayitEkle(){

        $rules = array(
            'isim'  => 'required|max:100|min:3',
            'email' => 'required|email',
            'konu'  => 'required|max:100|min:3',
            'mesaj' => 'required|max:500|min:3'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::to('page/iletisim')
                ->withErrors($validator);

        } else {
            $iletisim = new Iletisim();
            $iletisim->isim =  Input::get('isim');
            $iletisim->mail =  Input::get('email');
            $iletisim->konu =  Input::get('konu');
            $iletisim->mesaj =  Input::get('mesaj');
            $iletisim->save();
            return Redirect::to('page/iletisim')->with('status','Mesajınız başarıyla gönderildi. En kısa sürede irtibata geçilecektir. Teşekkür ederiz.');
        }

    }
}
