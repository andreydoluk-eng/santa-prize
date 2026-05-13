<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Equipment;

use App\Models\Equipment;
use App\MoonShine\Resources\Equipment\Pages\EquipmentFormPage;
use App\MoonShine\Resources\Equipment\Pages\EquipmentIndexPage;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\MenuManager\Attributes\Group;
use MoonShine\MenuManager\Attributes\Order;
use MoonShine\Support\Attributes\Icon;
use MoonShine\Support\Enums\SortDirection;
use MoonShine\Support\Enums\PageType;

/**
 * @extends ModelResource<Equipment, EquipmentIndexPage, EquipmentFormPage, null>
 */
#[Icon('truck')]
#[Group('Контент')]
#[Order(10)]
final class EquipmentResource extends ModelResource
{
    protected string $model = Equipment::class;

    protected string $column = 'title';

    protected string $sortColumn = 'sorting';

    protected SortDirection $sortDirection = SortDirection::ASC;

    protected ?PageType $redirectAfterSave = PageType::INDEX;

    public function getTitle(): string
    {
        return 'Спецтехніка';
    }

    protected function pages(): array
    {
        return [
            EquipmentIndexPage::class,
            EquipmentFormPage::class,
        ];
    }

    protected function search(): array
    {
        return ['title', 'slug'];
    }

}
