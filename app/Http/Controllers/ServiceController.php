<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Service;
use App\Support\FrontendCache;
use Illuminate\Contracts\View\View;

final class ServiceController extends Controller
{
    public function index(): View
    {
        $items = Service::query()->orderBy('sorting')->get();

        return view('catalog.index', [
            'entityTitle' => 'Послуги',
            'entityRoute' => 'services.show',
            'items' => $items,
            'seoTitle' => 'Послуги | SANTA-PRIZE',
            'seoDescription' => 'Послуги будівельної та спеціальної техніки.',
        ]);
    }

    public function show(string $slug): View
    {
        $item = Service::query()->where('slug', $slug)->firstOrFail();
        $items = Service::query()->where('id', '!=', $item->id)->orderBy('sorting')->get();

        return view('catalog.show', [
            'item' => $item,
            'items' => $items,
            'otherServices' => 'Інші послуги',
            'entityTitle' => 'Послуги',
            'entityRoute' => 'services.show',
        ]);
    }
}
