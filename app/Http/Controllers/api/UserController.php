<?php

namespace App\Http\Controllers\api;

use App\User;
use Input;
use Hash;
use Auth;
use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Authenticatable;
use Validator;

class UserController extends Controller
{

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

}
