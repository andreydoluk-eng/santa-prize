<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Support\FrontendCache;
use Illuminate\Contracts\View\View;

final class EquipmentController extends Controller
{

    public function index(): View
    {
        $items = Equipment::query()->orderBy('sorting')->get();

        return view('catalog.index', [
            'entityTitle' => 'Спецтехніка',
            'entityRoute' => 'equipments.show',
            'items' => $items,
            'seoTitle' => 'Спецтехніка | SANTA-PRIZE',
            'seoDescription' => 'Оренда та послуги спецтехніки від SANTA-PRIZE.',
        ]);
    }

    public function show(string $slug): View
    {
        $item = Equipment::query()->where('slug', $slug)->firstOrFail();
        $items = Equipment::query()->where('id', '!=', $item->id)->orderBy('sorting')->get();

        return view('catalog.show', [
            'item' => $item,
            'items' => $items,
            'otherServices' => 'Інша техніка',
            'entityRoute' => 'equipments.show',
            'entityTitle' => 'Спецтехніка',
        ]);
    }
}
