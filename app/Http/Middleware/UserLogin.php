<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class UserLogin
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
        $auth = auth()->user();
        if($auth && ($auth->role_id==1 || $auth->role_id == 0 || $auth->role_id == 2)){
            return $next($request);
        }else{
            return redirect()->route('login');
        }
    }
}
