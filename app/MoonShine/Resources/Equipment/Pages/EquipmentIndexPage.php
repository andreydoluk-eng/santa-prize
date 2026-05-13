<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Equipment\Pages;

use App\MoonShine\Resources\Equipment\EquipmentResource;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;

/**
 * @extends IndexPage<EquipmentResource>
 */
final class EquipmentIndexPage extends IndexPage
{
    protected function fields(): iterable
    {
        return [
            ID::make(),
            //Number::make('Сортування', 'sorting')->sortable(),
            Text::make('Назва', 'title'),
            Text::make('Slug', 'slug'),
            Image::make('Головне зображення', 'main_image'),
        ];
    }

    protected function modifyListComponent(ComponentContract $component): ComponentContract
    {
        return parent::modifyListComponent($component)->reorderable(
            url: route('moonshine.reorder', ['model' => 'Equipment']),
            key: 'id'
        );
    }
}
