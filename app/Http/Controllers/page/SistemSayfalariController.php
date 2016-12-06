<?php

namespace App\Http\Controllers\page;
use App\page\SistemSayfa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SistemSayfalariController extends Controller
{
    protected function index($id){
        return view('page\show',['sayfaBilgileri'=>SistemSayfa::where('id',$id)->first()]);
    }
}