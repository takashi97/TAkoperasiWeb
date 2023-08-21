<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChecksAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        if (Auth::check() && Auth::user()->level === 'admin') {
            return $next($request);
            
            
        }
        

        return redirect('/');
    }
    /* Dummy Code error
    public function handle(Request $request, Closure $next)
    {
        
        if (Auth::check() && Auth::user()->level === 'admin') {
            return $next($request);
        }
        

        return redirect('/');
    }
    */
    /*  Dummy Code
    public function handle(Request $request, Closure $next)
    {
        
        if (Auth::check() && Auth::user()->level != 'admin') ) {
            session()->flash('message', 'Anda tidak dapat diakses, silahkan daftar atau kembali ke homepage');
            return redirect('/');
        }
        

        return $next($request);
    }
    */
}
