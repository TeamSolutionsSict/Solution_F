<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $user = User::where(['username', '=', $request->route('username')])->get();
        // dd();
        if(Auth::check()) {
            // $user = Auth::user()->username;
            if(Auth::user()->level == '2' && Auth::id() == $request->route('id')) 
                return $next($request);
            else if(Auth::user()->level == '1' && Auth::id() == $request->route('id'))
                return $next($request);
            else 
                return redirect()->route('get.Home');
        } else {
            return redirect()->route('get.Home');
        }
        
    }
}
