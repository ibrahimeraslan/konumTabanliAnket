<?php

namespace App\Http\Controllers\page;

use App\page\Sss;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SssController extends Controller
{
    protected function index(){
        return view('page\sss',['sorular'=>Sss::all()]);
    }
}
