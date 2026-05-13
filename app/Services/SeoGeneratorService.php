<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SeoGeneratorService
{
    public function generate(string $title, string $description): ?array
    {
        $apiKey = config('services.gemini.api_key');

        if (empty($apiKey)) {
            Log::warning('Gemini API key is not set.');
            return null;
        }

        $prompt = "Ти професійний SEO-спеціаліст. Згенеруй SEO-метадані українською мовою для вебсторінки послуги або спецтехніки. 
Локація: Нікопольський район (обов'язково врахуй це в ключових словах та описі).
Назва: '{$title}'.
Опис: '{$description}'.

Поверни ТІЛЬКИ валідний JSON-об'єкт без жодних додаткових символів чи маркдауну.
Структура:
{
  \"seo_title\": \"(максимум 60 символів)\",
  \"seo_description\": \"(максимум 160 символів)\",
  \"seo_keywords\": \"(ключові слова через кому, включаючи Нікополь/Нікопольський район)\"
}";

        try {
            $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}";


            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->timeout(30)->post($url, [
                        'contents' => [
                            [
                                'parts' => [
                                    ['text' => $prompt]
                                ]
                            ]
                        ],
                        'generationConfig' => [
                            'temperature' => 0.7,
                            'maxOutputTokens' => 2048,
                            'responseMimeType' => 'application/json',
                        ],
                    ]);

            Log::info('Gemini response status', ['status' => $response->status()]);

            if ($response->successful()) {
                $result = $response->json();

                Log::info('Gemini raw result', ['result' => $result]);

                $text = $result['candidates'][0]['content']['parts'][0]['text'] ?? '';

                // Очищення на випадок markdown
                $text = preg_replace('/```json\s*/i', '', $text);
                $text = preg_replace('/```\s*/i', '', $text);
                $text = preg_replace('/[\x00-\x1F\x7F]/u', ' ', $text); // прибирає control characters
                $text = trim($text);

                $data = json_decode($text, true);

                if (json_last_error() === JSON_ERROR_NONE && is_array($data)) {
                    Log::info('Gemini SEO generated successfully', ['data' => $data]);
                    return $data;
                }

                Log::error('Failed to parse Gemini JSON', ['text' => $text, 'error' => json_last_error_msg()]);
            } else {
                Log::error('Gemini API Error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
            }
        } catch (\Exception $e) {
            Log::error('SeoGeneratorService Exception', ['message' => $e->getMessage()]);
        }

        return null;
    }
}