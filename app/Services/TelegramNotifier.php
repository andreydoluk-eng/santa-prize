<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Application;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

final class TelegramNotifier
{
    public function notifyNewApplication(Application $application): void
    {
        $token = config('services.telegram.bot_token');
        $chatId = config('services.telegram.chat_id');

        if (empty($token) || empty($chatId)) {
            Log::warning('TelegramNotifier: token або chat_id порожні');
            return;
        }

        $phone = $application->phone;
        $phoneClean = preg_replace('/[^+\d]/', '', $phone);
        $phoneLine = "<code>{$phoneClean}</code>";

        $sourceUrl = $application->source_url ?: null;
        $urlLine = $sourceUrl
            ? "🌐 Сторінка: <a href=\"{$sourceUrl}\">{$sourceUrl}</a>"
            : "🌐 Сторінка: —";

        $message = "🔔 <b>аявка з сайту SANTA-PRIZE</b>\n\n" .
            "👤 <b>Ім'я:</b> {$application->name}\n\n" .
            "📞 <b>Телефон:</b> {$phoneLine}\n\n" .
            "💬 " . ($application->message ?: '—') . "\n\n" .
            $urlLine . "\n\n";

        $keyboard = null;
        if ($sourceUrl && !str_contains($sourceUrl, 'localhost')) {
            $keyboard = [
                'inline_keyboard' => [
                    [
                        ['text' => '🌐 Відкрити сторінку', 'url' => $sourceUrl],
                    ],
                ],
            ];
        }

        $params = [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'HTML',
        ];

        if ($keyboard) {
            $params['reply_markup'] = json_encode($keyboard);
        }

        try {
            $response = Http::timeout(15)->post("https://api.telegram.org/bot{$token}/sendMessage", $params);

            if ($response->successful()) {
                Log::info('Telegram message sent successfully');
            } else {
                Log::error('Telegram API error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
            }
        } catch (\Exception $e) {
            Log::error('TelegramNotifier exception', ['message' => $e->getMessage()]);
        }
    }
}