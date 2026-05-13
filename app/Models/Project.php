<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Concerns\HasGeneratedSlugAndSorting;
use Illuminate\Database\Eloquent\Model;

final class Project extends Model
{
    use HasGeneratedSlugAndSorting;

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
