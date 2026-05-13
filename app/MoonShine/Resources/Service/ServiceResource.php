<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Service;

use App\Models\Service;
use App\MoonShine\Resources\Service\Pages\ServiceFormPage;
use App\MoonShine\Resources\Service\Pages\ServiceIndexPage;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\MenuManager\Attributes\Group;
use MoonShine\MenuManager\Attributes\Order;
use MoonShine\Support\Attributes\Icon;
use MoonShine\Support\Enums\SortDirection;
use MoonShine\Support\Enums\PageType;

/**
 * @extends ModelResource<Service, ServiceIndexPage, ServiceFormPage, null>
 */
#[Icon('wrench-screwdriver')]
#[Group('Контент')]
#[Order(11)]
final class ServiceResource extends ModelResource
{
    protected string $model = Service::class;

    protected string $column = 'title';

    protected string $sortColumn = 'sorting';

    protected SortDirection $sortDirection = SortDirection::ASC;

    protected ?PageType $redirectAfterSave = PageType::INDEX;


    public function getTitle(): string
    {
        return 'Послуги';
    }

    protected function pages(): array
    {
        return [
            ServiceIndexPage::class,
            ServiceFormPage::class,
        ];
    }

    protected function search(): array
    {
        return ['id', 'title', 'slug'];
    }
}
