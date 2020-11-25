<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            switch ($guard)
            {
                case 'student':
                    return redirect()->route('student.home');
                    break;
                case 'instructor':
                    return redirect()->route('instructor.home');
                    break;
                case 'admin':
                    return redirect()->route('admin.home');
                    break;
                default:
                    return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
