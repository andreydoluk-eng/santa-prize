<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Application;

use Illuminate\Database\Eloquent\Model;
use App\Models\Application;
use App\MoonShine\Resources\Application\Pages\ApplicationIndexPage;
use App\MoonShine\Resources\Application\Pages\ApplicationFormPage;
use App\MoonShine\Resources\Application\Pages\ApplicationDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Support\Attributes\Icon;
use MoonShine\Support\Enums\SortDirection;
use MoonShine\Support\Enums\Action;
use MoonShine\Support\ListOf;



/**
 * @extends ModelResource<Application, ApplicationIndexPage, ApplicationFormPage, ApplicationDetailPage>
 */
#[Icon('bell')]
class ApplicationResource extends ModelResource
{
    protected string $model = Application::class;

    protected string $title = 'Заявки';

    protected string $column = 'name';

    protected string $sortColumn = 'created_at';

    protected SortDirection $sortDirection = SortDirection::DESC;
    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            ApplicationIndexPage::class,
            ApplicationFormPage::class,
            ApplicationDetailPage::class,
        ];
    }

    protected function activeActions(): ListOf
    {
        return new ListOf(Action::class, [Action::VIEW, Action::DELETE]);
    }
}
