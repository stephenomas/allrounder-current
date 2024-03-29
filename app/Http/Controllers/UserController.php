<?php

namespace App\Http\Controllers;

use DateTimeZone;
use Carbon\Carbon;
use App\Models\Ckd;
use App\Models\User;
use App\Models\Sales;
use App\Models\Branch;
use App\Models\Report;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Builder;

class UserController extends Controller
{
    public function login(){
        $now = Carbon::now('Africa/Lagos');
    //    dd($now->tzName);
        $data =  request();

         $status = User::where('email',$data['email'])->first();
         if(!isset($status)){
             return back()->with('message', 'Invalid Username or Password');
         }else{
             if($status->position !='active'){
                 return back()->with('message', 'Inactive account');
             }
         }



         if (Auth::attempt(['email'=>$data['email'], 'password' =>$data['password'], 'position'=>'active' ])) {
            $status->update([
                'login' => $now
            ]);
             return redirect('/dashboard');
         }else{

             return back()->with('message', 'Invalid Username or Password');
         }

     }
     public function create(){
         $bran = Branch::all();
         return view('add-user', compact('bran'));
     }
     public function store(Request $request){
            $data = $request->validate([
                'name' => '',
                'email' => '',
                'password' => 'confirmed',
                'phone' => "unique:users",
                'branch' => ''

            ]);
            if(request()->has('superadmin')){
                $user =  User::create([
                    'position' => 'active',
                    'email' => $data['email'],
                    'name' => $data['name'],
                    'phone' => $data['phone'],
                    'branch_id' => $data['branch'],
                    'role' => 1,
                    'password' => Hash::make($data['password']),
                    'login' => null,
                    'logout' => null,

                ]);
                $user->access()->create([
                    'addproduct' => null,
                    'viewproduct' => null,
                    'dashboard' => null,
                    'saleslist' => null,
                    'newsale' => null,
                    'adduser' => null,
                    'viewuser' => null,
                    'addbranch' => null,
                    'viewbranch' => null,
                    'addreport' => null,
                    'viewreport' => null,

                ]);
            }else{


           $user =  User::create([
                'position' => 'active',
                'email' => $data['email'],
                'name' => $data['name'],
                'phone' => $data['phone'],
                'branch_id' => $data['branch'],
                'role' => 2,
                'password' => Hash::make($data['password']),
                'login' => null,
                'logout' => null,


            ]);

            $user->access()->create([
                'addproduct' => $request->addproduct,
                'viewproduct' => $request->viewproduct,
                'dashboard' => $request->dashboard,
                'saleslist' => $request->saleslist,
                'newsale' => $request->newsale,
                'adduser' => $request->adduser,
                'viewuser' => $request->viewuser,
                'addbranch' => $request->addbranch,
                'viewbranch' => $request->viewbranch,
                'addreport' => $request->addreport,
                'viewreport' => $request->viewreport,
                'warehouse' => $request->warehouse,

            ]);
        }

            return back()->with('message', 'User created successfully');


     }

     public function index(){
         $users = User::where('id', '>', 1)->where('position', 'active')->get();
         return view('users', compact('users'));
     }

     public function edit($id){
         if($id ==1){
             return back();
         }
         $user = User::findOrFail($id);
        $bran = Branch::all();
        return view('edit-user', compact('user', 'bran'));
    }

    public function update(Request $request, $id){
        if($id ==1){
            return back();
        }
        $user = User::findOrFail($id);
        $data = tap(request()->validate([
            'name' => '',
            'email' => '',
            'phone' => '',
            'branch' => '',
        ]),


        function(){
            if(!empty(request('password'))){
                request()->validate([
                    'password' => 'confirmed'
                ]);
            }

        });
        if(request()->has('superadmin')){


        if(!empty(request('password'))){
            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'branch_id' => $data['branch'],
                'role' => 1,
                'password' => Hash::make(request('password'))
            ]);
        }else{
            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'role' => 1,
                'branch_id' => $data['branch'],

            ]);
        }

        $user->access->update([
            'addproduct' => null,
            'viewproduct' => null,
            'dashboard' => null,
            'saleslist' => null,
            'newsale' => null,
            'adduser' => null,
            'viewuser' => null,
            'addbranch' => null,
            'viewbranch' => null,
            'addreport' => null,
            'viewreport' => null,

        ]);
    }else{
        if(!empty(request('password'))){
            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'branch_id' => $data['branch'],
                'role' => 2,
                'password' => Hash::make($request->password)
            ]);
        }else{
            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'role' => 2,
                'branch_id' => $data['branch'],

            ]);

        }

            $user->access->update([
            'addproduct' => $request->addproduct,
            'viewproduct' => $request->viewproduct,
            'dashboard' => $request->dashboard,
            'saleslist' => $request->saleslist,
            'newsale' => $request->newsale,
            'adduser' => $request->adduser,
            'viewuser' => $request->viewuser,
            'addbranch' => $request->addbranch,
            'viewbranch' => $request->viewbranch,
            'addreport' => $request->addreport,
            'viewreport' => $request->viewreport,
            'warehouse' => $request->warehouse

            ]);

    }

    return back()->with('message', 'Details updated successfully');
    }


    public function showadmin()
    {
        $user = Auth::user();
        $branch = Branch::all();
        return view('setting', compact('user', 'branch'));
    }

    public function updateadmin(Request $request)
    {
        $user = Auth::user();
        if(Auth::user()->email != $request->email){
            $data = tap(request()->validate([
                'name' => '',
                'email' => 'unique:user',
                'phone' => ''

            ]),

            function(){
                if(!empty(request('oldpassword')) and !empty(request('password'))){
                    request()->validate([
                        'password' => 'confirmed'
                    ]);
                }

            });
        }else{
            $data = tap(request()->validate([
                'name' => '',
                'phone' => ''


            ]),

            function(){
                if(!empty(request('oldpassword')) and !empty(request('password'))){
                    request()->validate([
                        'password' => 'confirmed'
                    ]);
                }

            });
        }

        if(request()->hasFile('photo')){
            $gimages = $request->photo;
            $gbasename = Str::random();
            $goriginal = $gbasename.'.'.$gimages->getClientOriginalExtension();
            $gimages->move('upload/', $goriginal);
            $gimagepath = 'upload/'.$goriginal;
            // $inter = Image::make(public_path($gimagepath))->fit(1000, 1200);
            // $inter->save();

            $user->update([
                'photo' => $gimagepath,
            ]);
        }

        if(!empty(request('password')) and !empty(request('oldpassword'))){
            if(Hash::check($request->oldpassword, $user->password)){
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'branch_id' => $request->branch,
                    'password' => Hash::make($request->password)
                ]);
            }else{
                return back()->with('err', 'invalid old password');
            }

        }else{
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'branch_id' => $request->branch,

            ]);

        }
        return back()->with('message', 'Account updated successfully');


    }

    public function delete(User $user){
        if($user->id == 1){
            return back();
        }
       // $user->access->delete();
        $user->update([
            'position' => 'inactive'
        ]);
        return back()->with('message', 'User deleted successfully');

    }

    public function logout()
    {
        $now = Carbon::now(new DateTimeZone('Africa/Lagos'));
        Auth::user()->update([
            'logout' => $now
        ]);
        Auth::logout();
        return redirect('/login');
    }


    public function dashboard(Request $request){
        $sal = 0;
        $todayt = 0;
        $todaym = 0;
        $today_ckd_m = 0;
        $today_ckd_t = 0;
        $now  = \Carbon\Carbon::today()->toDate();
        $branches = Branch::all();

        if(Auth::user()->role == 1){
            $branch = $request->branch && $request->branch != 0 ? Branch::findOrFail($request->branch) : false;
            $ckdm = $branch ? $branch->ckd()->where('type', 'Motorcycle')->get()->sum('amount') : Ckd::where('type', 'Motorcycle')->get()->sum('amount');
            $ckdt = $branch ? $branch->ckd()->where('type', 'Tricycle')->get()->sum('amount') : Ckd::where('type', 'Tricycle')->get()->sum('amount');

            $pendingSales = $branch ? $branch->sales()->where('paymentstatus', 'Pending')->get() : Sales::where('paymentstatus', 'Pending')->get();

            $sale = $branch ? $branch->sales()->where('paymentstatus', 'Paid')->orWhere('paymentstatus', 'Pending')->get() : Sales::where('paymentstatus', 'Paid')->orWhere('paymentstatus', 'Pending')->get();

            foreach($sale as $sales){

                $sal = $sal  + $sales->unit;
                $saled = \Carbon\Carbon::parse($sales->created_at)->toDate();
                if($saled >= $now  ){
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
            $ckdsoldm = $branch ? $branch->sales()->where('ckd_type', 'like', '%motor%')->get() : Sales::where('ckd_type', 'like', '%motor%')->get();
            $ckdsoldt =  $branch ? $branch->sales()->where('ckd_type', 'like', '%tric%')->get() : Sales::where('ckd_type', 'like', '%tric%')->get();

            foreach($ckdsoldm as $m){
                $sell = \Carbon\Carbon::parse($m->created_at)->toDate();
                if($sell >= $now){
                    $today_ckd_m = $today_ckd_m + $m->unit;
                }
            }

            foreach($ckdsoldt as $t){
                $sell = \Carbon\Carbon::parse($t->created_at)->toDate();
                if($sell >= $now){
                    $today_ckd_t = $today_ckd_t + $t->unit;
                }
            }
            $todaym = $todaym + $today_ckd_m;
            $todayt = $todayt + $today_ckd_t;

            $prod = $branch ? $branch->products : Product::all();

            $availm = $branch ? Product::whereHas('spec', function (Builder $query) use($branch) {
                $query->where('branch_id', $branch->id);
            })->where('status', 'available')->where('type', 'motorcycle')->get() :Product::where('status', 'available')->where('type', 'motorcycle')->get() ;

            $availt = $branch ?  Product::whereHas('spec', function (Builder $query) use($branch) {
                $query->where('branch_id',$branch->id);
            })->where('status', 'available')->where('type', 'tricycle')->get() :  Product::where('status', 'available')->where('type', 'tricycle')->get() ;

            $soldm = $branch ?  Product::whereHas('spec', function (Builder $query) use($branch) {
                $query->where('branch_id', $branch->id);
            })->where('status', 'sold')->where('type', 'motorcycle')->get() : Product::where('status', 'sold')->where('type', 'motorcycle')->get();

            $soldt = $branch ?  Product::whereHas('spec', function (Builder $query) use($branch) {
                $query->where('branch_id', $branch->id);
            })->where('status', 'sold')->where('type', 'tricycle')->get() : Product::where('status', 'sold')->where('type', 'tricycle')->get() ;


            $report = Report::where('from', 0)->orderBy('id', 'desc')->limit(3)->get();

        }else{
            $ckdm = Ckd::where('type', 'Motorcycle')->where('branch_id', Auth::user()->branch_id)->get()->sum('amount');
            $ckdt = Ckd::where('type', 'Tricycle')->where('branch_id', Auth::user()->branch_id)->get()->sum('amount');

                $pendingSales = Sales::where('branch_id', Auth::user()->branch_id)->where('paymentstatus', 'Pending')->get();
                $sale = Sales::where('branch_id', Auth::user()->branch_id)
                ->where('paymentstatus', 'Paid')
                ->orWhere('paymentstatus', 'Pending')->get();

                $now  = \Carbon\Carbon::today()->toDate();
                foreach($sale as $sales){

                    $sal = $sal  + $sales->unit;
                    $saled = \Carbon\Carbon::parse($sales->created_at)->toDate();
                    if($saled >= $now  ){
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
                $id = Auth::user()->branch_id;
                $ckdsoldm = Sales::where('spec_type', 'like', '%motor%')->where('branch_id', $id)->get();
                $ckdsoldt = Sales::where('spec_type', 'like', '%tric%')->where('branch_id', $id)->get();

                foreach($ckdsoldm as $m){
                    $sell = \Carbon\Carbon::parse($m->created_at)->toDate();
                    if($sell >= $now){
                        $today_ckd_m = $today_ckd_m + $m->unit;
                    }
                }

                foreach($ckdsoldt as $t){
                    $sell = \Carbon\Carbon::parse($t->created_at)->toDate();
                    if($sell >= $now){
                        $today_ckd_t = $today_ckd_t + $t->unit;
                    }
                }
                $todaym = $todaym + $today_ckd_m;
                $todayt = $todayt + $today_ckd_t;



                $prod = Product::whereHas('spec', function (Builder $query) {
                $query->where('branch_id', Auth::user()->branch_id);
            })->get();



            $availm = Product::whereHas('spec', function (Builder $query) {
                $query->where('branch_id', Auth::user()->branch_id);
            })->where('status', 'available')->where('type', 'motorcycle')->get();

            $availt = Product::whereHas('spec', function (Builder $query) {
                $query->where('branch_id', Auth::user()->branch_id);
            })->where('status', 'available')->where('type', 'tricycle')->get();

            $soldm = Product::whereHas('spec', function (Builder $query) {
                $query->where('branch_id', Auth::user()->branch_id);
            })->where('status', 'sold')->where('type', 'motorcycle')->get();

            $soldt =  Product::whereHas('spec', function (Builder $query) {
                $query->where('branch_id', Auth::user()->branch_id);
            })->where('status', 'sold')->where('type', 'tricycle')->get();


            $report = Report::where('from', Auth::user()->id)->orderBy('id', 'desc')->limit(1)->get();
        }
        return view('dashboard', compact('sale','todayt','todaym','soldm','soldt','prod','availt','availm','report', 'sal', 'ckdm', 'ckdt', 'ckdsoldm', 'ckdsoldt', 'branches', 'pendingSales'));

    }
}
