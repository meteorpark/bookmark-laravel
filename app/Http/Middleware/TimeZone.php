<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;

class TimeZone
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

        date_default_timezone_set('UTC');
        Config::set('app.timezone', $this->detectedTimezone);

        return $next($request);
    }
}
