<?php

namespace CodeZero\LocalizedRoutes\Middleware\Detectors;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;

class CookieDetector implements Detector
{
    /**
     * Detect the locale.
     *
     * @return string|array|null
     */
    public function detect()
    {
        $key = Config::get('localized-routes.cookie_name');

        // Laravel encrypts cookies by default. When the locale cookie is set
        // outside of Laravel's encryption (e.g. client-side), read it raw.
        if (Config::get('localized-routes.check_raw_cookie')) {
            return $_COOKIE[$key] ?? null;
        }

        return Cookie::get($key);
    }
}
