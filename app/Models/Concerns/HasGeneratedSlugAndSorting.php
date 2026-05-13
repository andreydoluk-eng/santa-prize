<?php

declare(strict_types=1);

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait HasGeneratedSlugAndSorting
{
    protected static function bootHasGeneratedSlugAndSorting(): void
    {
        static::saving(function ($model): void {
            if (blank($model->sorting)) {
                $model->sorting = ((int) $model->newQuery()->max('sorting')) + 1;
            }

            if (filled($model->title) && blank($model->slug)) {
                $model->slug = static::generateUniqueSlug($model->title, $model->getKey());
            }
        });
    }

    protected static function generateUniqueSlug(string $title, mixed $exceptId = null): string
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $counter = 1;

        while (static::query()
            ->when($exceptId, fn ($query) => $query->whereKeyNot($exceptId))
            ->where('slug', $slug)
            ->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}
