<?php

declare(strict_types=1);

namespace App\Http\Controllers\MoonShine;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use InvalidArgumentException;

class ReorderController extends Controller
{
    public function __invoke(Request $request, string $model): JsonResponse
    {
        $data = $request->input('data');
        
        if (blank($data)) {
            return response()->json(['success' => false]);
        }

        $modelClass = 'App\\Models\\' . $model;
        
        if (!class_exists($modelClass)) {
            throw new InvalidArgumentException("Model {$modelClass} not found.");
        }

        // SortableJS sends data as comma separated string or array.
        $ids = is_array($data) ? $data : explode(',', $data);
        
        foreach ($ids as $index => $id) {
            $modelClass::where('id', $id)->update(['sorting' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
