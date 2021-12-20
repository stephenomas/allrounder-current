<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class viewproduct
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!isset(Auth::user()->role)){
            return redirect('/login');
        }
        elseif(Auth::user()->role > 1 ){
            if(Auth::user()->access->viewproduct != 1){
                if(Auth::user()->access->newsale == 1){
                    return redirect('/new-sale');
                }elseif(Auth::user()->access->adduser == 1){
                    return redirect('/user/create');
                }elseif(Auth::user()->access->dashboard == 1){
                    return redirect('/dashboard');
                }elseif(Auth::user()->access->addbranch == 1){
                    return redirect('/add-branch');
                }elseif(Auth::user()->access->addreport == 1){
                    return redirect('/add-report');
                }elseif(Auth::user()->access->addnumber == 1){
                    return redirect('/add-number');
                }elseif(Auth::user()->access->addbrand == 1){
                    return redirect('/add-brand');
                }elseif(Auth::user()->access->addmodel == 1){
                    return redirect('/add-model');
                }
            }
        }
        return $next($request);
    }
}
