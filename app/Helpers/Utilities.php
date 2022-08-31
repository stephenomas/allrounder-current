<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Auth;


class Utilities{

    public static function admin(){
        if(Auth::user()->role == 1){
            return true;
        }else{
            return false;
        }
    }
}
