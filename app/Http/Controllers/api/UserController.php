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

}
