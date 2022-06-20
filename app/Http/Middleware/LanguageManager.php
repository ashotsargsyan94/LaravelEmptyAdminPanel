<?php

namespace App\Http\Middleware;

use App\Services\LanguageManager\Facades\LanguageManager as Manager;
use Closure;

class LanguageManager
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
        $result = Manager::middleware();
        return $result?$result:$next($request);
    }
}
