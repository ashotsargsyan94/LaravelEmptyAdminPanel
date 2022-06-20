<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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
        if (Auth::check() &&  Auth::user()->isAdmin()) {
            app()->setLocale('ru');
            return $next($request);
        }
        return redirect()->route('admin.login');
    }
}
