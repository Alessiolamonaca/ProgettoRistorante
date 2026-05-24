<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $supported = config('locales.supported', ['it']);
        $default   = config('locales.default', 'it');

        // Legge il parametro {locale} dalla route
        $locale = $request->route('locale');

        if (! is_string($locale) || ! in_array($locale, $supported, true)) {
            $locale = $default;
        }

        app()->setLocale($locale);
        app()->setFallbackLocale($default);

        return $next($request);
    }
}
