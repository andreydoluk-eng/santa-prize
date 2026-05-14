<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SeoGeneratorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SeoGeneratorController extends Controller
{
    public function generate(Request $request, SeoGeneratorService $service): JsonResponse
    {
        $request->validate([
            'title' => ['required', 'string'],
            'description' => ['nullable', 'string'],
        ]);

        $title = $request->string('title')->toString();
        $description = strip_tags($request->string('description', '')->toString());

        $data = $service->generate($title, $description);

        if (!$data) {
            return response()->json(['error' => 'Не вдалось згенерувати SEO'], 500);
        }

        return response()->json($data);
    }
}