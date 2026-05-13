<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use App\MoonShine\Resources\Equipment\EquipmentResource;
use App\MoonShine\Resources\MoonShineUser\MoonShineUserResource;
use App\MoonShine\Resources\MoonShineUserRole\MoonShineUserRoleResource;
use App\MoonShine\Resources\Project\ProjectResource;
use App\MoonShine\Resources\Service\ServiceResource;
use MoonShine\AssetManager\InlineJs;
use MoonShine\AssetManager\Js;
use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\ColorManager\Palettes\PurplePalette;
use MoonShine\ColorManager\ColorManager;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Contracts\ColorManager\PaletteContract;
use MoonShine\MenuManager\MenuGroup;
use MoonShine\MenuManager\MenuItem;
use App\MoonShine\Resources\Application\ApplicationResource;
use MoonShine\MenuManager\MenuDivider;

final class MoonShineLayout extends AppLayout
{
    /**
     * @var null|class-string<PaletteContract>
     */
    protected ?string $palette = PurplePalette::class;


    protected function menu(): array
    {
        return [
            MenuItem::make(EquipmentResource::class),
            MenuItem::make(ServiceResource::class),
            MenuItem::make(ProjectResource::class),
            MenuDivider::make(),
            MenuItem::make(ApplicationResource::class, 'Заявки'),
            MenuDivider::make(),

            MenuGroup::make('Система', [
                MenuItem::make(MoonShineUserResource::class),
                MenuItem::make(MoonShineUserRoleResource::class),
            ])->icon('folder'),

        ];
    }

    /**
     * @param ColorManager $colorManager
     */
    protected function colors(ColorManagerContract $colorManager): void
    {
        parent::colors($colorManager);

        // $colorManager->primary('#00000');
    }

    protected function getFooterCopyright(): string
    {
        return 'Santa-Prize © ' . date('Y');
    }

    protected function getFooterMenu(): array
    {
        return [];
    }
}
