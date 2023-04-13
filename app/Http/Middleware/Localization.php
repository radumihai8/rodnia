<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Localization
{
    public function handle(Request $request, Closure $next)
    {
        $acceptableLocales  = ['en', 'de', 'fr', 'pl', 'ro', 'tr', 'cz', 'it'];

        if (session()->has('locale')) {
            app()->setLocale(session()->get('locale'));
        } else {
            $lang = $request->getPreferredLanguage($acceptableLocales);

            if ($lang) {
                app()->setLocale($lang);
                session()->put('locale', $lang);
            }

        }
        return $next($request);
    }
}
