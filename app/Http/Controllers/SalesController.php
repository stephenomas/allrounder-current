<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Ckd;
use App\Models\Spec;
use App\Models\Sales;
use App\Models\Branch;
use App\Models\Product;
use App\Mail\SalesReport;
use App\Helpers\Utilities;
use App\Mail\DailySalesMaiil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Builder;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $id = Auth::user()->id;
        $role = Auth::user()->role;
        if($role == 1){
            $sale = Sales::orderBy('id', 'desc')->get();
        }else{
            $sale = Sales::where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc')->get();
        }

        return view('sales-list', compact('sale'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $branch = Auth::user()->branch_id;
        $prod = Product::where('status', 'available')->whereHas('spec',function(Builder $query) use ($branch){
            $query->where('branch_id', $branch);
        })->get();
        return view('new-sale', compact('prod'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale = Sales::findOrFail($id);
        $uid = Auth::user()->id;
        $role = Auth::user()->role;
        if($role == 1 || $sale->user_id == $uid){
            $sale = Sales::findOrFail($id);
            return view('invoice', compact('sale'));

        }else{
            return back();
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->role != 1){
            return back();
        }
        $sale = Sales::findOrFail($id);
        $uid = Auth::user()->id;
        $role = Auth::user()->role;
        if($role == 1 || $sale->user_id == $uid){

            $prod = Product::where('status', 'available')->get();
            return view('edit-sale', compact('sale','prod'));
        }else{
          return back();
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $sale = Sales::findOrFail($id);

        $sale->update([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'address' => $request->address,
            'paymentmethod' => $request->paymentmethod,
            'paymentstatus' => $request->paymentstatus,
            'account' => $request->account,

        ]);

        if($request->paymentstatus == 'Refunded'){
            foreach($sale->salesitem as $item){


                $item->product->update([
                    'status' => 'available'
                ]);
            }
        }else{
            foreach($sale->salesitem as $item){


                $item->product->update([
                    'status' => 'sold'
                ]);
            }
        }
        return back()->with('message', 'Sale edited successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addcart(Request $request){
        $Product = Product::where('chasisnumber', $request->product)->first();
        if(!$Product){
            return back();
        }
        $price  = $Product->spec->price;
        $userID = Auth::user()->id;
        \Cart::session($userID)->add(array(
            'id' => $Product->id,
            'name' => $Product->chasisnumber,
            'price' => $price,
            'quantity' => 1,
            'attributes' => array(
                'note' => $request->note
            ),
            'associatedModel' => $Product
        ));

        $Product->update([
            'status' => 'sold'
        ]);

        return back();
    }

    public function removecart($id)
    {
        $userId = Auth::user()->id;

        $prod = Product::where('id',$id )->first();
        $prod->update([
            'status' => 'available'
        ]);

        \Cart::session($userId)->remove($id);
        return redirect('/new-sale');

    }

    public function buyer()
    {
        $userId = Auth::user()->id;
        $con = \Cart::session($userId)->getContent();
        if($con->count() < 1){
            return redirect('/new-sale');
        }else{
            return view('buyer-details');
        }

    }

    public function buyersave(Request $request)
    {
        $userId = Auth::user()->id;
        $branch = Auth::user()->branch->id;
        $con = \Cart::session($userId)->getContent();
        $num = \Cart::session($userId)->getContent()->count();
        $sale = Auth::user()->sales()->create([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'address' => $request->address,
            'paymentmethod' => $request->paymentmethod,
            'paymentstatus' => $request->paymentstatus,
            'no_of_ckd' => 0,
            'account' => $request->account,
            'unit' => $num,
            'price' => $request->price,
            'branch_id' => $branch
        ]);

        foreach($con as $co){

            $sale->salesitem()->create([
                'product_id' => $co->associatedModel->id,
                'note' =>$co->attributes->note,
                'price' => $co->price
            ]);

            $prod = Product::where('id',$co->associatedModel->id )->first();
            $prod->update([
                'status' => 'sold'
            ]);
        }
        \Cart::session($userId)->clear();
        $report = [
            'sale' => $sale,
            'items' => $sale->salesitem

        ];
        $status = true;
        Mail::to('dan.allrounder@gmail.com')->send(new DailySalesMaiil($status,$report));
        return view('invoice', compact('sale'));

    }

    public function delete(Sales $sales){
        $user = Auth::user();
        $status = false;
        if($user->role == 1){
            if($sales->ckd_type != null || !empty($sales->ckd_type)){
                $report = [
                    'sale' => $sales,
                    'items' => null

                ];
                $spec =  Spec::where('name', $sales->ckd_type)->where('branch_id', Auth::user()->branch_id)->first();

                if($spec){
                    $ckd = $spec->ckd;
                    if($ckd){
                        $new = $ckd->amount + $sales->unit;
                        $ckd->update([
                            'amount' => $new
                        ]);
                    }
                }
            }else{
                $report = [
                    'sale' => $sales,
                    'items' => $sales->salesitem
                ];
                foreach($sales->salesitem as $items){
                    $prod = Product::where('id',$items->product_id)->first();
                    if(isset($prod)){
                        $prod->update([
                            'status' => 'available'
                        ]);
                    }
                    $items->delete();
                }
            }
            $sales->delete();
          //  Mail::to('fewgenesis@gmail.com')->send(new DailySalesMaiil($status,$report));
            return back()->with('message', 'Sales delete successfully');
        }else{
            return back();
        }
    }

    public function report_index(Request $request){
        if($request->start && $request->end){
            $end = Carbon::parse($request->end)->addDay();
            if(Utilities::admin()){
                $branch = $request->branch;
                    if($request->branch == 0){
                        $sale = Sales::where('created_at', '>=', $request->start)->where('created_at', '<=', $end)->get();
                    }else{
                        $sale = Sales::where('created_at', '>=', $request->start)->where('created_at', '<=', $end)->where('branch_id', $branch)->get();
                    }
            }else{
                $branch = Auth::user()->branch->id;

                    $sale = Sales::where('created_at', '>=', $request->start)->where('created_at', '<=', $end)->where('branch_id', Auth::user()->branch_id)->get();
            }
        }else{
            $sale= [];
        }

        $branch = Branch::all();
        return view('sales-report', compact('branch', 'sale'));
    }

    public function ckd_view(){
        $branch = Auth::user()->branch->id;
        $specs = Spec::where('name', 'like', '%CKD%')->where('branch_id', $branch)->get();
        return view('new-sale-ckd', compact('specs'));
    }

    public function ckd_sale(Request $request){
         $branch = Auth::user()->branch->id;
        $request->validate([
            'name' => 'required',
            'number' => 'required',
            'address' => 'required',
            'ckd_type' => 'required',
            'no_of_ckd' => 'required',
            'paymentmethod' => 'required',
            'paymentstatus' => 'required'
        ]);

        $type = $request->ckd_type;
        $spec = Spec::find($type);
        $ckd = Ckd::where('spec_id', $spec->id)->first();
        if(!$ckd){
            return back()->with('failed', 'CKD not found');
        }elseif($ckd->amount < $request->no_of_ckd){
            return back()->with('failed', 'Only '.$ckd->amount.' left in the system');
        }
            $sale = Auth::user()->sales()->create([
                'name' => $request->name,
                'email' => $request->email,
                'number' => $request->number,
                'address' => $request->address,
                'paymentmethod' => $request->paymentmethod,
                'paymentstatus' => $request->paymentstatus,
                'account' => $request->account,
                'unit' => $request->no_of_ckd,
                'no_of_ckd' => $request->no_of_ckd,
                'price' => $spec->price * $request->no_of_ckd,
                'ckd_type' => $spec->name,
                'no_of_engine' => $request->engines,
                'no_of_bolts' => $request->bolts,
                'spec_type' => $spec->type,
                'branch_id' => $branch
            ]);
        if($sale){
            $num = $ckd->amount - $request->no_of_ckd;
            $ckd->update([
                'amount' => $num
            ]);
            $report = [
                'sale' => $sale,
                'items' => null

            ];
            $status = true;
            Mail::to('dan.allrounder@gmail.com')->send(new DailySalesMaiil($status,$report));
            return view('invoice', compact('sale'));
        }

    }




    public function send_sales_report(){
        $now  =\Carbon\Carbon::today()->toDateString();
        $nowstring = \Carbon\Carbon::today()->toDateString();

        $branches = Branch::all();
        $reports = [];

        foreach($branches as $branch){
            $todaym = 0;
            $todayt = 0;
            $today_ckd_m = 0;
            $today_ckd_t = 0;
            $amount = 0;
            $today_sale = 0;

            $sale = Sales::where('branch_id', $branch->id)
            ->where(function($query){
                $query->where('paymentstatus', 'Paid')
                ->orWhere('paymentstatus', 'Pending');
            })
            ->get();
            foreach($sale as $sales){
                $saled = \Carbon\Carbon::parse($sales->created_at)->toDateString();

                if($saled == $nowstring){
                    $today_sale =   $today_sale + $sales->price;
                    foreach($sales->salesitem as $item){
                        if(isset($item->product)){
                            if($item->product->type == 'Motorcycle'){
                                $todaym = $todaym + 1;
                            }elseif($item->product->type == 'Tricycle'){
                                $todayt = $todayt + 1;
                            }
                        }
                    }

                }
            }

            $ckdsoldm = Sales::where('spec_type', 'like', '%motor%')->where('branch_id', $branch->id)->get();
            $ckdsoldt = Sales::where('spec_type', 'like', '%tric%')->where('branch_id', $branch->id)->get();
            foreach($ckdsoldm as $m){
                $sell = \Carbon\Carbon::parse($m->created_at)->toDateString();
                if($sell == $now){

                    $today_ckd_m = $today_ckd_m + $m->unit;
                }
            }

            foreach($ckdsoldt as $t){
                $sell = \Carbon\Carbon::parse($t->created_at)->toDateString();
                if($sell == $now){

                    $today_ckd_t = $today_ckd_t + $t->unit;
                }
            }
            $todaym = $todaym + $today_ckd_m;
            $todayt = $todayt + $today_ckd_t;



            $reports = array_merge($reports, [[
                "branch" => $branch->name,
                "motorcycles" => $todaym,
                "tricycles" => $todayt,
                "amount" => $today_sale,
                "date" => $nowstring
            ]]);                                                                                                                                                                                                                                                                                                                                                                                
        }



        Mail::to('dan.allrounder@gmail.com')->cc('biz.allrounder@gmail.com')->send(new SalesReport($reports));
    }


}

