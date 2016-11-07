<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FunctionController extends Controller
{
    public static function secenekOlustur($tip,$cevap){
        if($tip == 1){
            return "<input type='text' class='form-control' value='$cevap'>";
        }else if($tip == 2){
            return "<input type='checkbox' class='form-control' value='$cevap'>";
        }else if($tip == 3){
            return "<input type='radio' class='form-control' value='$cevap'>";
        }
        else if($tip == 4){
            return "<select class='form-control'><option value='$cevap'>$cevap</option></select>";
        }
    }
}
