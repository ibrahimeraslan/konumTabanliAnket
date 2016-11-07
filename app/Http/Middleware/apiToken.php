<?php

namespace App\Http\Middleware;

use Closure;
use Input;
use App\User;
use Response;

class apiToken
{
    public function handle($request, Closure $next)
    {
        if (User::where('id', '=', Input::get('id'))->where('api_token','=',Input::get('token'))->first()){
            return $next($request);
        }
        else{
            return Response::json( [
                'trpoll' => [
                    'case' => 0,
                    'message' => "Token Hatası",
                ]
            ], 401 );
        }

    }
}
