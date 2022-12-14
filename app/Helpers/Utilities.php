<?php
namespace App\Helpers;

use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;


class Utilities{

    public static function admin(){
        if(Auth::user()->role == 1){
            return true;
        }else{
            return false;
        }
    }

    public static function notification(){
        $user = Auth::user();
        if($user->role ==1 || $user->access->warehouse == 1){
            $branch = $user->branch->id;
            $warehouse =Warehouse::where('status', 'pending')->where('destination_id', $branch)->first();
            return $warehouse ? true : false;
        }
    }
}
