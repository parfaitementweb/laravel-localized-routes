<?php

namespace CodeZero\LocalizedRoutes\Tests\Unit\Middleware\Detectors;

use CodeZero\LocalizedRoutes\Middleware\Detectors\CookieDetector;
use CodeZero\LocalizedRoutes\Tests\TestCase;
use Illuminate\Support\Facades\Config;
use PHPUnit\Framework\Attributes\Test;

final class CookieDetectorTest extends TestCase
{
    #[Test]
    public function it_reads_the_raw_cookie_when_check_raw_cookie_is_enabled(): void
    {
        Config::set('localized-routes.cookie_name', 'locale');
        Config::set('localized-routes.check_raw_cookie', true);

        $_COOKIE['locale'] = 'nl';

        $this->assertEquals('nl', (new CookieDetector)->detect());

        unset($_COOKIE['locale']);
    }

    #[Test]
    public function it_returns_null_when_check_raw_cookie_is_enabled_and_the_cookie_is_missing(): void
    {
        Config::set('localized-routes.cookie_name', 'locale');
        Config::set('localized-routes.check_raw_cookie', true);

        unset($_COOKIE['locale']);

        $this->assertNull((new CookieDetector)->detect());
    }
}
