<?php

declare(strict_types=1);

namespace App\Observers;

use App\Support\FrontendCache;

final class ContentObserver
{
    public function saved(object $model): void
    {
        FrontendCache::clear();
    }

    public function deleted(object $model): void
    {
        FrontendCache::clear();
    }
}
