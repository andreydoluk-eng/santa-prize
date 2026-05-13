<?php

declare(strict_types=1);

namespace App\Support;

use Closure;
use Illuminate\Support\Facades\Cache;

final class FrontendCache
{
    public static function remember(string $key, Closure $callback, int $ttl = 3600): mixed
    {
        return Cache::remember(self::versionedKey($key), $ttl, $callback);
    }

    public static function clear(): void
    {
        Cache::increment('frontend_cache_version');
    }

    private static function versionedKey(string $key): string
    {
        $version = Cache::rememberForever('frontend_cache_version', fn (): int => 1);

        return "frontend:v{$version}:{$key}";
    }
}
