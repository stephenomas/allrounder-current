<?php

namespace App\Http\Controllers;

use App\Models\Spec;
use App\Models\Brand;
use App\Models\Branch;
use App\Models\Product;
use App\Models\SalesItem;
use App\Helpers\Utilities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Utilities::getBranches();
        $branch = Utilities::RequestBranch();
        $link = route('viewproducts');
         if(Auth::user()->role == 1){
            $prod = Product::when($branch, function($query) use($branch){
                $query->whereHas('spec',  function (Builder $query)use($branch) {
                    $query->where('branch_id', $branch->id);
                    });
            })->orderBy('id', 'desc')->get();

        }else{
            $id = Auth::user()->branch_id;
            $prod = Product::whereHas('spec',  function (Builder $query) {
            $query->where('branch_id', Auth::user()->branch_id);
            })->get();
        }

        return view('view-products', compact('prod', 'link', 'branches'));
    }
    public function inventory()
    {
        $branches = Utilities::getBranches();
        $branch = Utilities::RequestBranch();
        $link = route('inventory');
        if(Auth::user()->role == 1){
            $prod = Product::when($branch, function($query) use($branch){
                $query->whereHas('spec',  function (Builder $query)use($branch) {
                    $query->where('branch_id', $branch->id);
                    });
            })->where('status', 'available')->orderBy('id', 'desc')->get();

        }else{
            $id = Auth::user()->branch_id;
        $prod = Product::whereHas('spec', function (Builder $query) {
            $query->where('branch_id', Auth::user()->branch_id);
        })->where('status', 'available')->orderBy('id', 'desc')->get();
        }

        return view('view-products', compact('prod', 'link', 'branches'));
    }
    public function stats()
    {
        $prod = Spec::all();
        return view('view-stats', compact('prod'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tricyclecreate()
    {
        $bran = Brand::all();
        return view('add-product', compact('bran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $branch = Auth::user()->branch_id;
        $mod = $request->spec_id;
        $spec = Spec::where('id', $mod)->first();
        $ch = $spec->chasisdigit;
        $en  = $spec->enginedigit;
        $type = $spec->type;
        $validate = $request->validate([
            'brand_id' => '',
            'chasisnumber' => 'unique:products|min:'.$ch.'|max:'.$ch.'',
            'enginenumber' => 'min:'.$en.'|max:'.$en.'',
            'engine' => '',
            'color' => 'required',
            'spec_id' => '',
            'trampoline' => '',
            'remark' => '',
        ]);
        $status = ['status'=>'available', 'type'=>$type, 'branch_id' => $branch];

        Auth::user()->product()->create(array_merge($validate, $status));
        return back()->with('message', 'Product added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $bran = Brand::all();
        $prod = Product::where('chasisnumber', $id)->first();
        return view('edit-product', compact('prod', 'bran'));
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
        $mod = $request->spec_id;
        $spec = Spec::where('id', $mod)->first();
        $ch = $spec->chasisdigit;
        $en  = $spec->enginedigit;
        $type = $spec->type;
        $prod = Product::where('chasisnumber', $id)->first();
        if($prod->chasisnumber == $request->chasisnumber){
            $validate = $request->validate([
                'brand_id' => '',
                'enginenumber' => 'min:'.$en.'',
                'engine' => '',
                'spec_id' => '',
                'color' => 'required',
                'trampoline' => '',
                'remark' => '',

            ]);
        }else{
            $validate = $request->validate([
                'chasisnumber' => 'unique:products|min:'.$ch.'|max:'.$ch.'',
                'enginenumber' => 'min:'.$en.'|max:'.$en.'',
                'brand_id' => '',
                'engine' => '',
                'color' => 'required',
                'spec_id' => '',
                'trampoline' => '',
                'remark' => '',
            ]);
        }
        $status = ['type'=>$type];


        $prod->update(array_merge($validate, $status));
        return redirect('/edit-product/'.$request->chasisnumber)->with('message', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('message', 'Product deleted successfully');
    }

    public function createbrand()
    {
        return view('add-brand');
    }

    public function indexbrand()
    {   $prod = Brand::all();
        return view('view-brand', compact('prod'));
    }

    public function storebrand(Request $request)
    {
        $data = request()->validate([
            'name' => 'unique:brands'
        ]);

        Brand::create($request->all());

        return back()->with('message', 'Brand added successfully');
    }

    public function editbrand(Brand $brand)
    {
     return view('edit-brand', compact('brand'));
    }

    public function updatebrand(Request $request, Brand $brand)
    {   if($request->name != $brand->name){
        $data = request()->validate([
            'name' => 'unique:brands'
        ]);

    }

        $brand->update($request->all());

        return back()->with('message', 'Brand Updated successfully');
    }

    public function deletebrand(Brand $brand)
    {
        $brand->delete();
     return redirect('/view-brand')->with('message', 'Brand deleted successfully');
    }

    public function createmodel()
    {
        $bran = Brand::all();

        $branch = Branch::all();

        return view('add-model', compact('bran', 'branch'));
    }

    public function storemodel()
    {
        $data = request()->validate([
            'name' => 'unique:specs'
        ]);

        if(request()->has('branch')){
            $branch = request('branch');
        }else{
            $branch = Auth::user()->branch_id;
        }

        Spec::create([
            'name' => request('name'),
            'brand_id' => request('brand'),
            'type' => request('type'),
            'price' => request('price'),
            'engine' => request('engine'),
            'chasisdigit' => request('chasisdigit'),
            'enginedigit' => request('enginedigit'),
            'branch_id' => $branch
        ]);

       return back()->with('message', 'Model added successfully');
    }

    public function indexmodel()
    {
        $mod = Spec::all();

        return view('view-model', compact('mod'));
    }

    public function editmodel(Spec $spec)
    {
        $branch = Branch::all();
        $bran = Brand::all();
        return view('edit-model', compact('spec', 'bran', 'branch'));
    }

    public function updatemodel(Request $request, Spec $spec)
    {
        if(request()->has('branch')){
            $branch = request('branch');
        }else{
            $branch = Auth::user()->branch_id;
        }

        if($request->name != $spec->name){
            $data = request()->validate([
                'name'=>'unique:specs'
            ]);
        }

        $spec->update([
            'name' => request('name'),
            'brand_id' => request('brand'),
            'type' => request('type'),
            'price' => request('price'),
            'engine' => request('engine'),
            'chasisdigit' => request('chasisdigit'),
            'enginedigit' => request('enginedigit'),
            'branch_id' => $branch
        ]);

        return back()->with('message', 'Model updated successfully');
    }

    public function deletemodel(Spec $spec)
    {   $spec->product->delete();
        foreach( $spec->ckdhistory as $ckd){
            $ckd->delete();
        }
        $spec->ckd->delete();

        $spec->delete();
       return back()->with('message', 'Model deleted successfully');
    }

    public function brandsel(Brand $brand){
        $branch = Auth::user()->branch_id;
        $mod = Spec::where('brand_id', $brand->id)->where('branch_id', $branch)->get();
        if($mod->count() > 0 ){
            return response()->json($mod);
        }else{

            return response()->json();
        }

    }

    public function sold(){
        $branches = Utilities::getBranches();
        $branch = Utilities::RequestBranch();
        $link = route('soldproducts');
        if(Auth::user()->role == 1){
            $prod = Product::when($branch, function($query) use($branch){
                $query->whereHas('spec',  function (Builder $query)use($branch) {
                    $query->where('branch_id', $branch->id);
                    });
            })->where('status', 'sold')->orderBy('id', 'desc')->get();
        }else{
            $id = Auth::user()->branch_id;
            $prod = Product::whereHas('spec',  function (Builder $query) {
            $query->where('branch_id', Auth::user()->branch_id);
            })->where('status', 'sold')->orderBy('id', 'desc')->get();
        }

        return view('sold-products', compact('prod','link', 'branches'));
    }

    public function populate(){
        $products = Product::all();
        foreach($products as $pro){
            $branch = $pro->user->branch_id;
            $pro->update([
                'branch_id' => $branch
            ]);
        }
    }


}
