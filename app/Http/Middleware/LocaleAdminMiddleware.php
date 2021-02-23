<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Config\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocaleAdminMiddleware
{
    public static $mainLanguage = 'ge';

    public static $languages = [];
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = self::getLocale();
        if($locale)
            App::setLocale($locale);
        else
            App::setLocale(self::$mainLanguage);
        return $next($request);
    }

    /**
     * @return mixed|null
     */
    public static function getLocale()
    {
        $uri = request()->path();

        self::$languages = self::getLanguages();

        $segmentsURI = explode('/',$uri);

        if (!empty($segmentsURI[0]) && in_array($segmentsURI[0], self::$languages)) {
            if ($segmentsURI[0] != self::$mainLanguage) return $segmentsURI[0];
        }
        return null;
    }

    /**
     * @return Repository|mixed
     */
    public static function getLanguages()
    {
        return config('app.locales');
    }
}
