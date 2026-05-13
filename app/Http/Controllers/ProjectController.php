<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Project;
use App\Support\FrontendCache;
use Illuminate\Contracts\View\View;

final class ProjectController extends Controller
{
    public function index(): View
    {
        $items = Project::query()->orderBy('sorting')->get();

        return view('catalog.index', [
            'entityTitle' => 'Наші роботи',
            'entityRoute' => 'projects.show',
            'items' => $items,
            'seoTitle' => 'Наші роботи | SANTA-PRIZE',
            'seoDescription' => 'Реальні обʼєкти та виконані роботи SANTA-PRIZE.',
        ]);
    }

    public function show(string $slug): View
    {
        $item = Project::query()->where('slug', $slug)->firstOrFail();
        $items = Project::query()->where('id', '!=', $item->id)->orderBy('sorting')->get();

        return view('catalog.show', [
            'item' => $item,
            'items' => $items,
            'entityRoute' => 'projects.show',
            'otherServices' => 'Інші роботи',
            'entityTitle' => 'Наші роботи',
        ]);
    }
}
