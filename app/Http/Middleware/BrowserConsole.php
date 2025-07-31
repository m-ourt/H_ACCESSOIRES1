<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Monolog\Handler\BrowserConsoleHandler;

class BrowserConsole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        BrowserConsoleHandler:: send();
        return $response;
    }
}
