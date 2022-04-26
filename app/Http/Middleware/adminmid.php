<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminmid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {    if(!isset(Auth::user()->role)){
        return redirect('/login');
        }
        elseif(Auth::user()->role != 1 ){
        return view('denied');
         }
        return $next($request);
    }
}
