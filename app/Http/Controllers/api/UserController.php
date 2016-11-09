<?php

namespace App\Http\Controllers\api;

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
}
