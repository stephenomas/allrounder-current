<?php

namespace App\Http\Controllers;

use App\Models\Ckd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CkdController extends Controller
{
    public function create(){
        return view('add-ckd');
    }

    public function save(Request $request){
        $user = Auth::user()->id;
        $branch = Auth::user()->branch->id;
        $name = $request->name;

        $ckd = Ckd::where('name', $name)->where('branch_id', $branch)->first();

        if($ckd){
            return back()->with('error', 'Ckd already Exists');
        }else{
            $new =  Ckd::create([
                'name' => $name,
                'user_id' => $user,
                'type' => $request->type,
                'branch_id' => $branch,
                'remark' => $request->remark,
                'amount' => $request->amount
            ]);

            $new->ckdhistory()->create([
                'amount' => $request->amount,
                'user_id' => $user,
                'action' => true,
            ]);

            return back()->with('message', 'Ckd added successfully');
        }
    }

    public function index(){
        $branch = Auth::user()->branch->id;
        $prod = Ckd::where('branch_id', $branch)->get();

        return view('view-ckd', compact('prod'));
    }

    public function edit(Ckd $ckd){
        $branch = Auth::user()->branch->id;

        if($branch == $ckd->branch_id){
            return view('edit-ckd', compact('ckd'));
        }else{
            return back();
        }
    }

    public function update(Request $request, Ckd $ckd){
        $branch = Auth::user()->branch->id;
        if($branch == $ckd->branch_id){
            $user = Auth::user()->id;
            $newamount = (int)$request->amount;
            $oldamount = (int)$ckd->amount;

            if( $newamount > $oldamount  ){
                $ckd->ckdhistory()->create([
                    'amount' => ($request->amount - $ckd->amount),
                    'user_id' => $user,
                    'action' => true,
                ]);
            // dd($request->amount);
            }elseif( $newamount <  $oldamount){
                $ckd->ckdhistory()->create([
                    'amount' => ($ckd->amount - $request->amount),
                    'user_id' => $user,
                    'action' => false,
                ]);
              //  dd($ckd->amount);
            }
                $ckd->update([
                    'amount' => $request->amount,
                    'remark' => $request->remark
                ]);

            return back()->with('message', 'Record updated successfully');
        }else{
            return back();
        }
    }

    public function delete(Ckd $ckd){
        $branch = Auth::user()->branch->id;

        if($branch == $ckd->branch_id){

            $ckd->ckdhistory->delete();
            $ckd->delete();
            return back()->with('message', 'ckd deleted successfully');
        }else{
            return back();
        }
    }

    public function history(){
        $branch = Auth::user()->branch->id;
        $ckds = Ckd::where('branch_id', $branch)->get();
        $history = collect([]);
        foreach($ckds as $ckd){
           // dd($ckd->ckdhistory);
        $prod = $history->concat($ckd->ckdhistory);
        }
       // dd($prod);


        return view('ckdhistory', compact('prod'));
    }
}
