<?php

namespace App\Http\Controllers;


use App\Models\Sales;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $sale = Sales::whereHas('user', function(Builder $query){
                $query->where('branch_id', Auth::user()->branch_id);
            })
            ->orderBy('id', 'desc')->get();
        }

        return view('sales-list', compact('sale'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prod = Product::where('status', 'available')->get();
        return view('new-sale', compact('prod'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $con = \Cart::session($userId)->getContent();
        $num = \Cart::session($userId)->getContent()->count();
        $sale = Auth::user()->sales()->create([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'address' => $request->address,
            'paymentmethod' => $request->paymentmethod,
            'paymentstatus' => $request->paymentstatus,
            'account' => $request->account,
            'unit' => $num,
            'price' => $request->price,
        ]);

        foreach($con as $co){
            $sale->salesitem()->create([
                'product_id' => $co->associatedModel->id,
                'note' =>$co->attributes->note
            ]);

            $prod = Product::where('id',$co->associatedModel->id )->first();
            $prod->update([
                'status' => 'sold'
            ]);
        }
        \Cart::session($userId)->clear();
        return view('invoice', compact('sale'));

    }
}
