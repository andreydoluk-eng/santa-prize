<?php

declare(strict_types=1);

namespace App\Models\Concerns;

use App\Services\SeoGeneratorService;
use Illuminate\Database\Eloquent\Model;

trait GeneratesSeoMetadata
{
    protected static function bootGeneratesSeoMetadata(): void
    {
        \Log::info('bootGeneratesSeoMetadata registered for ' . static::class);
        static::saving(function (Model $model) {
            \Log::info('saving event fired', [
                'title' => $model->title,
                'seo_title' => $model->seo_title,
            ]);
            $needsSeo = empty($model->seo_title) || empty($model->seo_description) || empty($model->seo_keywords);

            if ($needsSeo) {
                $title = $model->title ?? '';
                $description = strip_tags($model->description ?? '');

                if (!empty($title)) {
                    $generator = new SeoGeneratorService();
                    $seoData = $generator->generate($title, $description);

                    if ($seoData) {
                        if (empty($model->seo_title) && !empty($seoData['seo_title'])) {
                            $model->seo_title = $seoData['seo_title'];
                        }
                        if (empty($model->seo_description) && !empty($seoData['seo_description'])) {
                            $model->seo_description = $seoData['seo_description'];
                        }
                        if (empty($model->seo_keywords) && !empty($seoData['seo_keywords'])) {
                            $model->seo_keywords = $seoData['seo_keywords'];
                        }
                    }
                }
            }
        });
    }
}
