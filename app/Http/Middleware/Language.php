<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Language
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
        if ($request->lang) {
            session(['lang' => $request->lang]);
        }

        if (session('lang')) {
            app()->setLocale(session('lang'));    
        } else {
            app()->setLocale(config('app.fallback_locale'));
        }

        return $next($request);
    }
}
