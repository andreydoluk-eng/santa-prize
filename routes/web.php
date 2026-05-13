<?php

declare(strict_types=1);

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Models\Equipment;
use App\Models\Project;
use App\Models\Service;
use App\Support\FrontendCache;
use Illuminate\Support\Facades\Route;
use MoonShine\Laravel\Http\Middleware\Authenticate;

Route::get('/', HomeController::class)->name('home');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

Route::get('/spetstekhnika', [EquipmentController::class, 'index'])->name('equipments.index');
Route::get('/spetstekhnika/{slug}', [EquipmentController::class, 'show'])->name('equipments.show');

Route::get('/poslugy', [ServiceController::class, 'index'])->name('services.index');
Route::get('/poslugy/{slug}', [ServiceController::class, 'show'])->name('services.show');

Route::get('/obiekty', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/obiekty/{slug}', [ProjectController::class, 'show'])->name('projects.show');

Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');

Route::middleware([Authenticate::class])->group(function () {
    Route::post('/admin/reorder/{model}', \App\Http\Controllers\MoonShine\ReorderController::class)
        ->name('moonshine.reorder');
});

Route::get('/sitemap.xml', function () {
    $sitemap = FrontendCache::remember('sitemap.xml', function (): string {
        $urls = collect([
            route('home'),
            route('categories'),
            route('equipments.index'),
            route('services.index'),
            route('projects.index'),
        ])
            ->merge(Equipment::query()->pluck('slug')->map(fn (string $slug): string => route('equipments.show', $slug)))
            ->merge(Service::query()->pluck('slug')->map(fn (string $slug): string => route('services.show', $slug)))
            ->merge(Project::query()->pluck('slug')->map(fn (string $slug): string => route('projects.show', $slug)))
            ->unique()
            ->values();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($urls as $url) {
            $xml .= "<url><loc>{$url}</loc></url>";
        }

        $xml .= '</urlset>';

        return $xml;
    });

    return response($sitemap, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
})->name('sitemap');
