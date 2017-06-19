<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role = null)
    {
        if ($role != null)
        {
            
            $user = User::find(Auth::user()->id);

            if (strtolower($role) == 'administrator')
            {
                if (Auth::check() && ($user->hasRole('super-admin') || $user->hasRole('admin'))) {
                    return $next($request);
                } else {
                    return redirect('/access-denied');
                }
            }
            else if (strtolower($role) == 'jpn-ppd')
            {
                if (Auth::check() && ($user->hasRole('jpn') || $user->hasRole('ppd'))) {
                    return $next($request);
                } else {
                    return redirect('/access-denied');
                }
            }
            else
            {
                if (Auth::check() && $user->hasRole($role)) {
                    return $next($request);
                } else {
                    return redirect('/access-denied');
                }
            }
        }
        else
        {
            return redirect('/access-denied');
        }
    }
}
