<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Spec;
use App\Models\Product;
use App\Models\Inventory;
use App\Helpers\Utilities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function populate(){
        $specs = Spec::all();
        foreach($specs as $spec){
            if(count($spec->product) > 0){
                $amount = $spec->product()->where('status', 'available')->count();
                $spec->inventory()->create([
                    'amount' => $amount
                ]);
            }else{
                if($spec->ckd){
                    $spec->inventory()->create([
                        'amount' => $spec->ckd->amount
                    ]);
                }
            }
        }
        return response()->json([], 200);
    }


    public function search(Request $request){
        $branch = $request->branch;
        $start = Carbon::parse($request->start_date)->toDateString();
        $end = Carbon::parse($request->end_date)->addDay()->toDateString();
        $inventory = Inventory::where('created_at', '>', $start)->where('created_at', '<', $end)->get();
        return response()->json($inventory, 200);
    }

    public function addition(Request $request){
        $branches = Utilities::getBranches();
        $branch = Utilities::RequestBranch();
        $start = Carbon::parse($request->start_date)->toDateString();
        $end = Carbon::parse($request->end_date)->addDay()->toDateString();
        if(Auth::user()->role == 1){
            $specs = Spec::when($branch, function($query, $branch){
                $query->where('branch_id', $branch->id);
            })->orderBy('id', 'desc')->get();

        }else{
            $id = Auth::user()->branch_id;
            $specs =Spec::where('branch_id', $id)->orderBy('id', 'desc')->get();
        }
        $added_array = [];
        foreach($specs as $spec){
            if(count($spec->product) > 0){
               $added = $spec->product()->where('created_at','>', $start)->where('created_at', '<', $end)->get();
               $added_array[$spec->id] =  count($added);
            }
        }
        $added_array = $request->start_date ? $added_array : [];
      //  dd($added_array);
        return view('added-stock', compact('added_array', 'start', 'end', 'branches', 'branch'));

    }
}
