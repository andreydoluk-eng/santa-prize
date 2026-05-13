<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
#[\MoonShine\MenuManager\Attributes\SkipMenu]

class Dashboard extends Page
{

    /**
     * @return array<string, string>
     */
    public function getBreadcrumbs(): array
    {
        return [
            '#' => $this->getTitle()
        ];
    }

    public function getTitle(): string
    {
        return $this->title ?: 'Головна';
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        return [
            \MoonShine\UI\Components\Layout\Grid::make([
                \MoonShine\UI\Components\Layout\Column::make([
                    \MoonShine\UI\Components\Metrics\Wrapped\ValueMetric::make('Спецтехніка')
                        ->value(\App\Models\Equipment::count())
                        ->icon('truck')
                        ->customAttributes([
                            'onclick' => "window.location.href='" . app(\App\MoonShine\Resources\Equipment\EquipmentResource::class)->getUrl() . "'",
                            'style' => 'cursor: pointer;'
                        ]),
                ])->columnSpan(3),

                \MoonShine\UI\Components\Layout\Column::make([
                    \MoonShine\UI\Components\Metrics\Wrapped\ValueMetric::make('Послуги')
                        ->value(\App\Models\Service::count())
                        ->icon('wrench')
                        ->customAttributes([
                            'onclick' => "window.location.href='" . app(\App\MoonShine\Resources\Service\ServiceResource::class)->getUrl() . "'",
                            'style' => 'cursor: pointer;'
                        ]),
                ])->columnSpan(3),

                \MoonShine\UI\Components\Layout\Column::make([
                    \MoonShine\UI\Components\Metrics\Wrapped\ValueMetric::make('Наші роботи')
                        ->value(\App\Models\Project::count())
                        ->icon('briefcase')
                        ->customAttributes([
                            'onclick' => "window.location.href='" . app(\App\MoonShine\Resources\Project\ProjectResource::class)->getUrl() . "'",
                            'style' => 'cursor: pointer;'
                        ]),
                ])->columnSpan(3),

                \MoonShine\UI\Components\Layout\Column::make([
                    \MoonShine\UI\Components\Metrics\Wrapped\ValueMetric::make('Заявки')
                        ->value(\App\Models\Application::count())
                        ->icon('document-text')
                        ->customAttributes([
                            'onclick' => "window.location.href='" . app(\App\MoonShine\Resources\Application\ApplicationResource::class)->getUrl() . "'",
                            'style' => 'cursor: pointer;'
                        ]),
                ])->columnSpan(3),
            ]),
            
            \MoonShine\UI\Components\Layout\Grid::make([
                \MoonShine\UI\Components\Layout\Column::make([
                    \MoonShine\UI\Components\Layout\Box::make('Налаштування сайту', [
                        \MoonShine\UI\Components\FormBuilder::make(route('admin.update-settings'), \MoonShine\Support\Enums\FormMethod::POST)
                            ->fields([
                                \MoonShine\UI\Fields\Text::make('Email', 'email')
                                    ->default(
                                        \Illuminate\Support\Facades\Storage::exists('settings.json') 
                                        ? (json_decode(\Illuminate\Support\Facades\Storage::get('settings.json'), true)['email'] ?? 'info@santa-prize.com') 
                                        : 'info@santa-prize.com'
                                    ),
                                \MoonShine\UI\Fields\Text::make('Телефон', 'phone')
                                    ->default(
                                        \Illuminate\Support\Facades\Storage::exists('settings.json') 
                                        ? (json_decode(\Illuminate\Support\Facades\Storage::get('settings.json'), true)['phone'] ?? '+380 (XX) XXX-XX-XX') 
                                        : '+380 (XX) XXX-XX-XX'
                                    ),
                                \MoonShine\UI\Fields\Textarea::make('Текст під заголовком (Головна)', 'hero_subtitle')
                                    ->default(
                                        \Illuminate\Support\Facades\Storage::exists('settings.json') 
                                        ? (json_decode(\Illuminate\Support\Facades\Storage::get('settings.json'), true)['hero_subtitle'] ?? 'Надаємо в оренду будівельної та спеціалізованої техніки для виконання різноманітних робіт.') 
                                        : 'Надаємо в оренду будівельної та спеціалізованої техніки для виконання різноманітних робіт.'
                                    ),
                                \MoonShine\UI\Fields\Textarea::make('Текст "Про компанію" (Головна)', 'about_text')
                                    ->default(
                                        \Illuminate\Support\Facades\Storage::exists('settings.json') 
                                        ? (json_decode(\Illuminate\Support\Facades\Storage::get('settings.json'), true)['about_text'] ?? 'Надаємо в оренду будівельної та спеціалізованої техніки для виконання різноманітних робіт — від земляних до висотних та дорожніх.') 
                                        : 'Надаємо в оренду будівельної та спеціалізованої техніки для виконання різноманітних робіт — від земляних до висотних та дорожніх.'
                                    )
                            ])
                            ->submit('Зберегти', ['class' => 'btn-primary'])
                    ])
                ])->columnSpan(12)->customAttributes(['class' => 'mt-8'])
            ])
        ];
    }
}
