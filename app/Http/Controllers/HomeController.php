<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Project;
use App\Models\Service;
use App\Support\FrontendCache;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

final class HomeController extends Controller
{
    public function __invoke(): View
    {
        $data = [
            'equipments' => Schema::hasTable('equipments') ? Equipment::query()->orderBy('sorting')->limit(3)->get() : new Collection(),
            'services' => Schema::hasTable('services') ? Service::query()->orderBy('sorting')->limit(6)->get() : new Collection(),
            'projects' => Schema::hasTable('projects') ? Project::query()->orderBy('sorting')->limit(6)->get() : new Collection(),
        ];

        return view('home', $data);
    }
}
