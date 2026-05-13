<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Models\Application;
use App\Services\TelegramNotifier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

final class ApplicationController extends Controller
{
    public function store(StoreApplicationRequest $request, TelegramNotifier $telegramNotifier)
    {

        $application = Application::query()->create($request->validated());

        $telegramNotifier->notifyNewApplication($application);

        Log::info('Application created', ['id' => $application->id]);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Заявка успішно надіслана.']);
        }

        return back()->with('success', 'Заявка успішно надіслана.');
    }
}
