<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Concerns\GeneratesSeoMetadata;
use App\Models\Concerns\HasGeneratedSlugAndSorting;
use Illuminate\Database\Eloquent\Model;

final class Equipment extends Model
{
    use GeneratesSeoMetadata;
    use HasGeneratedSlugAndSorting;

    protected $table = 'equipments';

    protected $fillable = [
        'sorting',
        'title',
        'slug',
        'description',
        'price',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'main_image',
        'gallery_images',
    ];

    protected function casts(): array
    {
        return [
            'gallery_images' => 'array',
        ];
    }
}
