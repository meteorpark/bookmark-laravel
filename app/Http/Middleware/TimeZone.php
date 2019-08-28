<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;

class TimeZone
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
// 사용자에 때라 언어셋 변경
//        $this->guessLocaleSession($request) || $this->guessLocaleBrowser($request);
//        if (empty($this->detectedLocale)) {
//            $this->detectedLocale = config('locale_detector.fallback_locale');
//        }
//        if (!empty($this->detectedLocale)) {
//            app()->setLocale($this->detectedLocale);
//        }
//        $this->guessTimezoneSession($request) || $this->guessTimezoneIp();
//        date_default_timezone_set('UTC');
//        Config::set('app.timezone', $this->detectedTimezone);
//        return $next($request);

        date_default_timezone_set('UTC');
        config(['app.timezone' => timezone()]);

        return $next($request);
    }
}
