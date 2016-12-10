<?php

namespace App\Http\Controllers;

use App\Meslek;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Input;
use Redirect;
use Image;
use Hash;
use DB;

class AyarController extends Controller
{
    protected function index(){
        $sorular = DB::table('uyelik_sorulari')
            ->where('tip',Auth::user()->tip)
            ->get();
        return view('panel\ayarlar',['meslekler'=>Meslek::all(),'FunctionController' => new FunctionController ,'sorular'=> $sorular]);
    }
    protected function anaBilgiler(){

        $rules = array(
            'isim'  => 'required|max:100|min:3',
            'dtarihi' => 'required|date',
            'meslek'  => 'required|min:1',
            'avatar' => 'image'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::to('kullanici/ayarlar')
                ->withErrors($validator);

        } else {
            $user = Auth::user();
            $user->name =  Input::get('isim');
            if(Input::file())
            {
                $image = Input::file('avatar');
                $filename  = time() . '.' . $image->getClientOriginalExtension();
                $path = public_path('img/avatar/' . $filename);
                Image::make($image->getRealPath())->resize(200, 200)->save($path);
                $user->avatar = $filename;
            }
            $user->dogum_tarihi =  Input::get('dtarihi');
            $user->meslek_id =  Input::get('meslek');
            $user->update();
            return Redirect::to('kullanici/ayarlar')->with('status','Ayarlarınız başarıyla kaydedildi.');
        }
    }
    protected function sifreDegistir(){
        $rules = array(
            'e_sifre' => 'required|min:6',
            'password' => 'required|min:6|confirmed'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::to('kullanici/ayarlar')
                ->withErrors($validator);
        }
        else{
            if(!Hash::check(Input::get('e_sifre'), Auth::user()->password)){
                return Redirect::to('kullanici/ayarlar')->withErrors('Kullanmış olduğunuz şifreyi hatalı girdiniz.');
            }
            else{
                $user = Auth::user();
                $user->password = bcrypt(Input::get('password'));
                $user->update();
                return Redirect::to('kullanici/ayarlar')->with('status','Şifreniz başarıyla değiştirildi.');
            }

        }
    }
    protected function hesapSil($mail){
        $user = User::where('id',Auth::user()->id)->where('email',$mail)->first();
        if($user){
            Auth::user()->delete();
            return Redirect::to('/')->with('status','Hesabınız başarıyla silindi. Bizi tercih ettiğiniz için teşekkür ederiz.');
        }
        else  return Redirect::to('kullanici/ayarlar')->withErrors('Yetkisiz işlem yapmaya çalıştınız.');
    }
}
