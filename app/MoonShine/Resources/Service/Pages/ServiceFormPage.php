<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Service\Pages;

use App\Models\Service;
use App\MoonShine\Resources\Service\ServiceResource;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use Povly\MoonshineInterventionImage\Fields\InterventionImage;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Fields\Hidden;
use MoonShine\TinyMce\Fields\TinyMce;

/**
 * @extends FormPage<ServiceResource, Service>
 */
final class ServiceFormPage extends FormPage
{
    protected function fields(): iterable
    {
        return [
            Grid::make([
                Column::make(
                    [
                        Box::make([
                            ID::make(),
                            Hidden::make('Сортування', 'sorting')->default(0),
                            Text::make('Назва', 'title')->required(),
                            Text::make('Slug', 'slug')->readonly(),
                            Text::make('Ціна', 'price'),
                            TinyMce::make('Опис', 'description'),

                        ]),
                    ],
                    colSpan: 6,
                    adaptiveColSpan: 6
                ),
                Column::make(
                    [
                        Box::make([

                            Text::make('SEO title', 'seo_title'),
                            Text::make('SEO keywords', 'seo_keywords'),
                            Textarea::make('SEO description', 'seo_description'),

                            InterventionImage::make('Головне зображення', 'main_image')
                                ->dir('equipments')
                                ->generateWebp()
                                ->generateAvif()
                                ->preset('banner')
                                ->maxDimensions(800, 600)
                                ->removable(),
                            InterventionImage::make('Галерея', 'gallery_images')
                                ->dir('equipments/gallery')
                                ->multiple()
                                ->generateWebp()
                                ->generateAvif()
                                ->preset('gallery')
                                ->removable(),
                        ]),
                    ],
                    colSpan: 6,
                    adaptiveColSpan: 6
                ),
            ]),

        ];
    }

    protected function rules(DataWrapperContract $item): array
    {
        $id = $item->getOriginal()->getKey();

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:equipments,slug,' . $id],
            'price' => ['nullable', 'string', 'max:255'],
        ];
    }

}