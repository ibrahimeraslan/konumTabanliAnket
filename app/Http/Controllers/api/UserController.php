<?php

namespace App\Http\Controllers\api;

use App\page\SistemSayfa;
use App\page\Iletisim;
use App\SistemAyar;
use App\User;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Input;
use Hash;
use Auth;
use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Authenticatable;
use Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\apiPasswordReset;
use Illuminate\Support\Str;
use DB;
use App\PasswordReset;

class UserController extends Controller
{
    use Notifiable;

    protected function login(){
        if (Auth::attempt(array('email' => Input::get('mail'), 'password' => Input::get('sifre')))){
            return Response::json( [
                'trpoll' => [
                    'case' => 1,
                    'user_id' => Auth::user()->id,
                    'message' => Auth::user()->api_token,
                ]
            ], 200);
        }
        else {
            return Response::json( [
                'trpoll' => [
                    'case' => 0,
                    'message' => "Mail adresiniz veya şifreniz hatalı",
                ]
            ], 401 );
        }

    }
    protected function bilgiCek()
    {
        return Response::json( [
            'trpoll' => [
                'case' => 1,
                'message' => User::where('id',Input::get('id'))->first(),
            ]
        ], 200);
    }
    protected function register(Request $request){
        $validator = Validator::make($request->all(), [
            'isim' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'sifre' => 'required|min:6|confirmed',
            'dogum_tarihi' => 'required',
            'meslek' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return Response::json( [
                'trpoll' => [
                    'case' => 0,
                    'message' => $validator,
                ]
            ], 400);
        }
        else{
           $user=  User::create([
                'name' => Input::get('isim'),
                'email' => Input::get('email'),
                'password' => bcrypt(Input::get('sifre')),
                'avatar' => 'logo.png',
                'dogum_tarihi' => Input::get('dogum_tarihi'),
                'meslek_id' => Input::get('meslek'),
                'tip' => 0,
                'durum' => 0,
                'api_token' => str_random(64),
            ]);

            if($user){
                return Response::json( [
                    'trpoll' => [
                        'case' => 1,
                        'message' => 'Hesabınız Başarıyla Oluşturuldu',
                    ]
                ], 200);
            } else {
                return Response::json( [
                    'trpoll' => [
                        'case' => 0,
                        'message' => 'Lütfen daha sonra deneyiniz.',
                    ]
                ], 400);
            }

        }
    }
    public function forgetPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'mail' => 'required|email|max:255|exists:users,email',
        ]);
        if ($validator->fails()) {
            return Response::json( [
                'trpoll' => [
                    'case' => 0,
                    'message' => $validator,
                ]
            ], 400);
        }
        else{
            $user = User::where('email',Input::get('mail'))->first();
            app('auth.password.broker')->createToken($user);
           Mail::to($user->email)->send(new apiPasswordReset(DB::table('password_resets')->where('email',Input::get('mail'))->first()->token));
           if(count(Mail::failures()) < 1){
               return Response::json( [
                   'trpoll' => [
                       'case' => 1,
                       'message' => "Şifre sıfırlama maili başarıyla gönderildi.",
                   ]
               ], 200);
           }else{
               return Response::json( [
                   'trpoll' => [
                       'case' => 0,
                       'message' => "Mail gönderim sırasında hata oluştu.",
                   ]
               ], 400);
           }


        }
    }
    protected function sifreDegistir(Request $request){
        $validator = Validator::make($request->all(), [
            'e_sifre' => 'required|min:6',
            'sifre' => 'required|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return Response::json( [
                'trpoll' => [
                    'case' => 0,
                    'message' => $validator,
                ]
            ], 400);
        } else{
            if(!Hash::check(Input::get('e_sifre'), User::where('id',Input::get('id'))->first()->password)){
                return Response::json( [
                    'trpoll' => [
                        'case' => 0,
                        'message' => $validator,
                    ]
                ], 400);
            }
            else{
                $user = User::where('id',Input::get('id'))->first();
                $user->password=bcrypt(Input::get('sifre'));
                $user->update();
                return Response::json( [
                    'trpoll' => [
                        'case' => 1,
                        'message' => "Şifreniz başarıyla değiştirildi.",
                    ]
                ], 200);
            }
        }
    }
    protected function bilgiDegistir(){
        $rules = array(
            'isim'  => 'required|max:100|min:3',
            'dtarihi' => 'required|date',
            'meslek'  => 'required|min:1',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json( [
                'trpoll' => [
                    'case' => 0,
                    'message' => $validator,
                ]
            ], 400);

        } else {
            $user = User::where('id',Input::get('id'))->first();
            $user->name =  Input::get('isim');
            $user->dogum_tarihi =  Input::get('dtarihi');
            $user->meslek_id =  Input::get('meslek');
            $user->update();
            return Response::json( [
                'trpoll' => [
                    'case' => 1,
                    'message' => "Bilgileriniz başarıyla değiştirildi.",
                ]
            ], 200);        }
    }
    protected function sistemAyarCek(){
        $setting = SistemAyar::all()->first();
        return Response::json( [
            'trpoll' => [
                'case' => 1,
                'message' => $setting,
            ]
        ], 200);
    }
    protected function iletisim(){
        $rules = array(
            'isim'  => 'required|max:100|min:3',
            'email' => 'required|email',
            'konu'  => 'required|max:100|min:3',
            'mesaj' => 'required|max:500|min:3'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Response::json( [
                'trpoll' => [
                    'case' => 0,
                    'message' => $validator,
                ]
            ], 400);

        } else {
            $iletisim = new Iletisim();
            $iletisim->isim =  Input::get('isim');
            $iletisim->mail =  Input::get('email');
            $iletisim->konu =  Input::get('konu');
            $iletisim->mesaj =  Input::get('mesaj');
            $iletisim->durum =  0;
            $iletisim->save();
            return Response::json( [
                'trpoll' => [
                    'case' => 1,
                    'message' => "Mesajınız başarıyla gönderildi. En kısa sürede irtibata geçilecektir. Teşekkür ederiz.",
                ]
            ], 200);
        }
    }
    protected function sistemSayfa($id){

        $sonuc = SistemSayfa::where('id',$id)->first();
        if($sonuc){
            return Response::json( [
                'trpoll' => [
                    'case' => 1,
                    'message' => $sonuc,
                ]
            ], 200);
        }
        else{
            return Response::json( [
                'trpoll' => [
                    'case' => 0,
                    'message' => "Hata Oluştu",
                ]
            ], 400);
        }
    }
    protected function kazanc(){
        $dAnketler = DB::table('doldurulmus_anketler')
            ->join('anketler', 'anketler.id', '=', 'doldurulmus_anketler.anket_id')
            ->where('doldurulmus_anketler.uye_id', '=', Input::get('id'))
            ->get();
        $toplamPara = DB::select(DB::raw('select sum(miktar) as toplam from para_aktarim_istekleri where user_id='.Input::get('id').' and durum=2'));
        $pIstekler = DB::table('para_aktarim_istekleri')->where('user_id',Input::get('id'))->get();
        $toplam = 0;
        foreach($dAnketler as $anket){
            if($anket->durum==2) $toplam = $toplam + $anket->anket_ucret;
        }
        $toplam = $toplam-($toplam*(SistemAyar::first()->ucret_kesintisi/100));
        $toplam = $toplam - $toplamPara[0]->toplam;
        return Response::json( [
            'trpoll' => [
                'case' => 1,
                'message' => $toplam,
            ]
        ], 200);
    }
}
