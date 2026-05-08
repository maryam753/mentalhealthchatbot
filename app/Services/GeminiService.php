<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    public function generateResponse(string $message): string
    {
        //   Crisis detection 
        $dangerWords = [
            'suicide',
            'kill myself',
            'end my life',
            'i want to die',
            'hopeless',
            'depression'
        ];
        foreach ($dangerWords as $word) {
            if (str_contains(strtolower($message), $word)) {
                return "I'm really sorry you're feeling this way 🤍  \nYou are not alone. Please talk to someone you trust or a mental health professional.  \nIf you're in immediate danger, seek help immediately.\n\n[HELPLINE_BUTTON]";
            }
        }

        $url = "https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent?key=" . env('GEMINI_API_KEY');

        try {

            //  API CALL RETRY
            $response = Http::timeout(20)
                ->retry(3, 2000)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                ])
                ->post($url, [
                    "contents" => [
                        [
                            "role" => "user",
                            "parts" => [
                                [
                                    "text" => "You are ElyBun, a supportive mental health chatbot.
Respond with empathy, warmth, and a calm tone.
Do not give medical diagnosis.

User: " . $message
                                ]
                            ]
                        ]
                    ]
                ]);

            //   LOG RESPONSE (FOR DEBUGGING)
            Log::info('Gemini Response', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            //  4. HANDLE API FAILURE
            if ($response->failed()) {

                Log::error('Gemini API Failed', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return "⚠️ AI service is busy right now. Please try again in a moment 🤍";
            }

            //   SAFE JSON PARSING
            $data = $response->json();

            return $data['candidates'][0]['content']['parts'][0]['text']
                ?? "I'm here for you 🤍 Please tell me more.";

        } 
        catch (\Exception $e) {

            //  CATCH ANY CRASH
            Log::error('Gemini Exception', [
                'message' => $e->getMessage()
            ]);

            return "⚠️ Network issue. Please try again later 🤍";
        }
    }

    // new function for title generated

    public function generateTitle(string $message): string
{
    $url = "https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent?key=" . env('GEMINI_API_KEY');

    $response = Http::post($url, [
        "contents" => [
            [
                "parts" => [
                    [
                        "text" => "Generate a short 4-6 word chat title for this message. 
Do not add quotes or punctuation. Only return title.

Message: " . $message
                    ]
                ]
            ]
        ]
    ]);

    if ($response->failed()) {
        return "New Chat";
    }

    $data = $response->json();

    return $data['candidates'][0]['content']['parts'][0]['text']
        ?? "New Chat";
}
}