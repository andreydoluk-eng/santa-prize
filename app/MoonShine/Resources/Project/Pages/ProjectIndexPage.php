<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Project\Pages;

use App\MoonShine\Resources\Project\ProjectResource;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;

/**
 * @extends IndexPage<ProjectResource>
 */
final class ProjectIndexPage extends IndexPage
{
    protected function fields(): iterable
    {
        return [
            ID::make()->sortable(),
            Number::make('Сортування', 'sorting')->sortable(),
            Text::make('Назва', 'title'),
            Text::make('Slug', 'slug'),
            Image::make('Головне зображення', 'main_image'),
        ];
    }

    protected function modifyListComponent(ComponentContract $component): ComponentContract
    {
        return parent::modifyListComponent($component)->reorderable(
            url: route('moonshine.reorder', ['model' => 'Project']),
            key: 'id'
        );
    }
}
