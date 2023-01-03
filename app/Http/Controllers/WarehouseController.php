<?php

namespace App\Http\Controllers;

use Cart;
use App\Models\Ckd;
use App\Models\Spec;
use App\Models\Branch;
use App\Models\Product;
use App\Models\Warehouse;
use App\Helpers\Utilities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class WarehouseController extends Controller
{
    private function get_branch(){
        $branch = Auth::user()->branch_id;
        $branches = Branch::where('id', '!=',  $branch)->get();
        $arr = [
            "user_branch" => $branch,
            "branches" => $branches
        ];
        return $arr;
    }
    public function transfer_cbu_create(){
        $branchmethod = $this->get_branch();
        $branch = $branchmethod['user_branch'];
        $prod = Product::where('status', 'available')->whereHas('spec', function(Builder $query) use ($branch) {
            $query->where('branch_id', $branch);
        })->get();
        $branches =  $branchmethod['branches'];
        return view('warehouse-cbu', compact('prod', 'branches'));
    }

    public function submit_transfer_ckd(Request $request){
        $user =  Auth::user();
        $branch = Auth::user()->branch->id;
        $request->validate([
            'branch' => 'required',
            'ckd_type' => 'required',
            'no_of_ckd' => 'required',

        ]);

        $type = $request->ckd_type;
        $spec = Spec::find($type);
        $ckd = Ckd::where('spec_id', $spec->id)->first();
        if(!$ckd){
            return back()->with('failed', 'CKD not found');
        }elseif($ckd->amount < $request->no_of_ckd){
            return back()->with('failed', 'Only '.$ckd->amount.' left in the system');
        }



        $num = $ckd->amount - $request->no_of_ckd;
        $ckd->update([
            'amount' => $num
        ]);


        $user->warehouses()->create([
            'branch_id' => $user->branch->id,
            'destination_id' => $request->branch,
            'ckd' => $ckd->id,
            'ckd_type' => $type,
            'no_of_ckd' => $request->no_of_ckd,
            'no_of_bolts' => $request->bolts,
            'no_of_engine' => $request->engines
        ]);

        return back()->with('success', 'Transfer Initiated successfully');
    }
    public function transfer_ckd_create(){
        $branchmethod = $this->get_branch();
        $branch = $branchmethod['user_branch'];
        $branches =  $branchmethod['branches'];
        $specs = Spec::where('name', 'like', '%CKD%')->where('branch_id', $branch)->get();
        return view('warehouse-ckd', compact('specs','branches' ));
    }

    public function submit_transfer_cbu(Request $request){
        $user =  Auth::user();
        $specs = Spec::where('branch_id', $user->branch->id)->get();
        $spec_array = [];
        $con = \Cart::session($user->id)->getContent();
        foreach($specs as $spec){
            $spec_array[$spec->id] = [];
            foreach($con as $co){
                $product =Product::find($co->associatedModel->id);
                if($product->spec_id == $spec->id){
                   // $spec_array[$spec->id] = $product->id;
                    array_push($spec_array[$spec->id],$product->id);
                }
                if($product->status != 'transit'){
                    $product->update([
                        'status' => 'transit'
                    ]);
                }

            }
        }
        $new_spec_array = array_filter($spec_array, function($id){
            return !empty($id);
        });



        $user->warehouses()->create([
            'branch_id' => $user->branch->id,
            'destination_id' => $request->branch,
            'cbu' => json_encode($new_spec_array),

        ]);
        \Cart::session($user->id)->clear();

        return back()->with('success', 'Transfer Initiated successfully');
    }

    public function incoming(){

        $branch = Auth::user()->branch->id;
        $specs = Spec::where('branch_id', $branch)->get();
        $ckds = Ckd::where('branch_id', $branch)->get();
        $packages = Warehouse::where('status', 'pending')->where('destination_id', $branch)->get();


        return view('warehouse-incoming', compact('packages', 'specs'));
    }

    public function incoming_save(Request $request){
        $request->validate([
            'spec' => 'required',
        ]);
        $package_id = $request->package;
        $package = Warehouse::find($package_id);
        if($package->cbu != null){
            $specs = $request->spec;
            $current = 0;
            $package_spec = json_decode($package->cbu);
            foreach($package_spec as $key => $values){
                foreach($values as $value){
                    $product = Product::find($value);
                    $product->update([
                        'status' => 'available',
                        'spec_id' => $specs[$current]
                    ]);
                }
                $current++;
            }
            $package->update([
                'status' => 'fufilled',
                'receiver_id' => Auth::user()->id
            ]);
            return back()->with('success', 'Accepted successfully');
        }else{
            $spec_id =$request->spec;
            $ckd = Ckd::where('spec_id', $spec_id)->first();
            $amount = $ckd->amount + $package->no_of_ckd;
            //dd($amount);
            $ckd->update([

                'amount' => $amount
            ]);
            $package->update([
                'status' => 'fufilled',
                'receiver_id' => Auth::user()->id
            ]);
            return back()->with('success', 'Accepted successfully');
        }

    }

    public function index_transfers(){
        $user = Auth::user();
        $transfers = Utilities::admin() ? Warehouse::all() : Warehouse::where('branch_id', $user->branch->id)->orWhere('destination_id', $user->branch->id)->get();
        return view('warehouse-history', compact('transfers'));
    }

    public function view_transfer(Warehouse $warehouse){
        $user = Auth::user();
        if($warehouse->destination_id != $user->branch_id && $warehouse->branch_id != $user->branch_id && !Utilities::admin()){
            return back();
        }
        return view('view-warehouse-transfer', compact('warehouse'));
    }

    public function edit_transfer(Warehouse $warehouse){
        $user = Auth::user();
        if($warehouse->status != 'pending'){
            return back();
        }
        if(!Utilities::admin() && $user->branch_id != $warehouse->branch_id ){
            return back();
        }
        $branch = $this->get_branch();
        $branches = $branch['branches'];
        $view = $warehouse->ckd == null ? 'edit-warehouse-cbu' : 'edit-warehouse-ckd';
        return view($view, compact('branches', 'warehouse'));
    }

    public function delete_transfer(Warehouse $warehouse){
        if($warehouse->status == 'fufilled'){
            return back();
        }
        if(!Utilities::admin()){
            if(Auth()->branch->id !== $warehouse->branch->id){
                return back();
            }
        }
        if($warehouse->cbu != NULL){
            $cbus = json_decode($warehouse->cbu);
            foreach($cbus as $cbu => $values){
                foreach ($values as $value){
                    $product = Product::find($value);
                    $product->update([
                        'status' => 'available'
                    ]);
                }
            }
            $warehouse->delete();
            return back()->with('success', 'Transfer Aborted Successfully');

        }else{
            $ckd = Ckd::find($warehouse->ckd);
            if($ckd){
                $amount = $ckd->amount + $warehouse->no_of_ckd;
                $ckd->update([
                    'amount' => $amount,
                ]);
            }
            $warehouse->delete();
            return back()->with('success', 'Transfer Aborted Successfully');
        }
    }

    public function save_transfer(Warehouse $warehouse, Request $request){
        if($warehouse->cbu != null && $warehouse->cbu != ''){
            if($warehouse->destination_id != $request->branch){
                $warehouse->update([
                    'destination_id' => $request->branch,
                ]);
                return back()->with('success', 'Transfer Updated Successfully');
            }else{
                return back();
            }

        }else{
            if($warehouse->no_of_ckd != $request->no_of_ckd){
                $warehouse->spec->ckd->update([
                    'amount' => ($warehouse->spec->ckd->amount + $warehouse->no_of_ckd) - $request->no_of_ckd
                ]);
            }
            $warehouse->update([
                'destination_id' => $request->branch,
                'no_of_ckd' => $request->no_of_ckd,
                'no_of_bolts' => $request->bolts,
                'no_of_engine' => $request->engines
            ]);

            return back()->with('success', 'Transfer updated successfully');
        }

    }

}

