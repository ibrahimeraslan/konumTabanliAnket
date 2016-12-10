<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Redirect;

class admin
{
    public function handle($request, Closure $next, $guard = null)
    {
		
    if (Auth::guard($guard)->guest()) {
		return Redirect::to('/')
                ->withErrors("Bu alana erişim yetkiniz bulunmuyor.");
	}
	if(Auth::check()) {
        if (Auth::user()->is_admin==1){
            return $next($request);
        }
        else{
            return Redirect::to('/')
                ->withErrors("Bu alana erişim yetkiniz bulunmuyor.");
        }
	}
    }
}
