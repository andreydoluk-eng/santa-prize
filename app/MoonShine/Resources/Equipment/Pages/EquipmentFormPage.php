<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Equipment\Pages;

use App\Models\Equipment;
use App\MoonShine\Resources\Equipment\EquipmentResource;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;
use MoonShine\TinyMce\Fields\TinyMce;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Hidden;
use Povly\MoonshineInterventionImage\Fields\InterventionImage;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\Layout\Column;

/**
 * @extends FormPage<EquipmentResource, Equipment>
 */
final class EquipmentFormPage extends FormPage
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

                            Text::make('SEO title', 'seo_title')
                                ->hint('Залиште порожнім для автоматичної генерації за допомогою ШІ (Gemini) для Нікопольського району'),
                            Text::make('SEO keywords', 'seo_keywords')
                                ->hint('Залиште порожнім для автоматичної генерації за допомогою ШІ'),
                            Textarea::make('SEO description', 'seo_description')
                                ->hint('Залиште порожнім для автоматичної генерації за допомогою ШІ'),

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
