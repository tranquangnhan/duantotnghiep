<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminloginMiddleware
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
        if (Auth::check())
        {
            $user=Auth::user();
            if ($user->role==1)
            {
                return $next($request);
            }
            else{
                return redirect('/')->with('thongbao', 'Bạn không phải là ADMIN');;
            }
        }else{
            return redirect('/admin/dangnhapadmin');
        }
    }
}
