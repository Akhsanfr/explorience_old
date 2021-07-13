<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Team
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
        if(Auth::check()){
            $user = Auth::user();
            if($user->hasRole('admin') || $user->hasRole('supervisor') || $user->hasRole('writer') || $user->hasRole('podcaster')){
                return $next($request);
            } else {
                return redirect(route('guest'));
            }
        } else {
            return redirect(route('guest'));
        }
    }
}
