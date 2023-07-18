<?php
namespace App\Helpers;

use App\Models\Branch;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;


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


    public static function getBranches() : Collection {
        $branches = Branch::all();
        return $branches;
    }

    public static function RequestBranch() : bool | Branch {
        $branch = request('branch') &&  request('branch') != 0 ? Branch::findOrFail( request('branch')) : false;
        return $branch;
    }

}
