<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserCan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        $user = $request->user();
        if(is_array($user->permissions)){
            if(in_array($permission, $user->permissions) ){
                return $next($request);
            }
        }
        
        return abort(404);
    }
}
