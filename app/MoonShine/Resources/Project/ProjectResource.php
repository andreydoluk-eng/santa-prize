<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Project;

use App\Models\Project;
use App\MoonShine\Resources\Project\Pages\ProjectFormPage;
use App\MoonShine\Resources\Project\Pages\ProjectIndexPage;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\MenuManager\Attributes\Group;
use MoonShine\MenuManager\Attributes\Order;
use MoonShine\Support\Attributes\Icon;
use MoonShine\Support\Enums\SortDirection;
use MoonShine\Support\Enums\PageType;

/**
 * @extends ModelResource<Project, ProjectIndexPage, ProjectFormPage, null>
 */
#[Icon('photo')]
#[Group('Контент')]
#[Order(12)]
final class ProjectResource extends ModelResource
{
    protected string $model = Project::class;

    protected string $column = 'title';

    protected string $sortColumn = 'sorting';

    protected SortDirection $sortDirection = SortDirection::ASC;

    protected ?PageType $redirectAfterSave = PageType::INDEX;


    public function getTitle(): string
    {
        return 'Наші роботи';
    }

    protected function pages(): array
    {
        return [
            ProjectIndexPage::class,
            ProjectFormPage::class,
        ];
    }

    protected function search(): array
    {
        return ['id', 'title', 'slug'];
    }
}
