<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;

class WelcomeController extends Controller
{
    public function anaSayfa(){
        $countNormalUser = User::where('tip',1)->count();
        $countSurveyUser = User::where('tip',2)->count();
        $countSurvey = DB::table('anketler')->count();
        $odeme = DB::table('para_aktarim_istekleri')->where('durum',2)->count();
        return view('welcome',['countNormalUser'=>$countNormalUser,'countSurveyUser'=>$countSurveyUser,'countSurvey'=>$countSurvey,'odeme'=>$odeme]);
    }
}
