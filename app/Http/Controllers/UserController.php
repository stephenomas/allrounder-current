<?php

namespace App\Http\Controllers;

use DateTimeZone;
use Carbon\Carbon;
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
                'phone' => "numeric",
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
            $gimages->move(public_path('/upload'), $goriginal);
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


    public function dashboard(){


        $sal = 0;
        $todayt = 0;
        $todaym = 0;

        if(Auth::user()->role == 1){

            $sale = Sales::where('paymentstatus', 'Paid')->orWhere('paymentstatus', 'Pending')->get();
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
            $prod = Product::all();
            $availm = Product::where('status', 'available')->where('type', 'motorcycle')->get();
            $availt = Product::where('status', 'available')->where('type', 'tricycle')->get();
            $soldm = Product::where('status', 'sold')->where('type', 'motorcycle')->get();
            $soldt =  Product::where('status', 'sold')->where('type', 'tricycle')->get();

            $report = Report::where('from', 0)->orderBy('id', 'desc')->limit(3)->get();

        }else{

                $sale = Sales::whereHas('user', function(Builder $query){
                    $query->where('branch_id', Auth::user()->branch_id);
                })
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
                $prod = Product::whereHas('user', function (Builder $query) {
                $query->where('branch_id', Auth::user()->branch_id);
            })->get();

            $availm = Product::whereHas('user', function (Builder $query) {
                $query->where('branch_id', Auth::user()->branch_id);
            })->where('status', 'available')->where('type', 'motorcycle')->get();

            $availt = Product::whereHas('user', function (Builder $query) {
                $query->where('branch_id', Auth::user()->branch_id);
            })->where('status', 'available')->where('type', 'tricycle')->get();

            $soldm = Product::whereHas('user', function (Builder $query) {
                $query->where('branch_id', Auth::user()->branch_id);
            })->where('status', 'sold')->where('type', 'motorcycle')->get();

            $soldt =  Product::whereHas('user', function (Builder $query) {
                $query->where('branch_id', Auth::user()->branch_id);
            })->where('status', 'sold')->where('type', 'tricycle')->get();


            $report = Report::where('from', Auth::user()->id)->orderBy('id', 'desc')->limit(1)->get();
        }
        return view('dashboard', compact('sale','todayt','todaym','soldm','soldt','prod','availt','availm','report', 'sal'));

    }
}
