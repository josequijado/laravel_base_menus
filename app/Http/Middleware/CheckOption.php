<?php

namespace App\Http\Middleware;

use Closure;
use Exception;

class CheckOption
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
        $ruta = auth()->user()->permissions
            ->where('ruta', request()->route()->getName())
            ->count();
        if ($ruta == 0) return redirect()->route('index');
        return $next($request);
    }
}
