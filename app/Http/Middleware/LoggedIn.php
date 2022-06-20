<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class LoggedIn
{

    public function handle($request, Closure $next)
    {
        if (User::auth()) {
            return $next($request);
        }
        return redirect()->route('login');
    }
}
