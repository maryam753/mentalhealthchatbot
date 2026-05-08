<?php

use BotMan\BotMan\BotMan;
use App\Services\GeminiService;

$botman = resolve('botman');

$botman->hears('{message}', function (BotMan $bot, $message) {
    $gemini = new GeminiService();
    $reply = $gemini->generateResponse($message);
    $bot->reply($reply);
});
