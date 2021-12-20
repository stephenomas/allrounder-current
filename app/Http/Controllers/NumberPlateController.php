<?php

namespace App\Http\Controllers;

use App\Models\NumberPlate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NumberPlateController extends Controller
{
    public function create(){
        return view('add-number');
    }

    public function store(Request $request){
        $max = $request->max;
        $min = $request->min;
        $pre = $request->prefix;
        $suf = $request->suffix;


        for($x = $min; $x <= $max; $x++){
                $num = $pre.$x.$suf;
                Auth::user()->numberplate()->create([
                    'numberplate' => $num
                ]);
        }

        return back()->with('success', 'Number Plates added successfully');
    }

    public function index(){
        $sale = NumberPlate::all();
        return view('number-list', compact('sale'));
    }

    public function delete($id, $numberplate){
        $plate = NumberPlate::where('id', $id)->where('numberplate', $numberplate)->firstOrFail();
        if(isset($plate)){
            $plate->delete();
            return back()->with('message', 'Number Plate deleted successfully');
        }
    }
}
