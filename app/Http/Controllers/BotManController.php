<?php
namespace App\Http\Controllers;
use App\Models\ChatMessage;
use Illuminate\Http\Request;

use BotMan\BotMan\BotMan;

class BotManController extends Controller
{
    // public function handle()
    // {
    //     $botman = app('botman');

    //     $botman->hears('hi|hello|hey', function (BotMan $bot) {
    //         $bot->reply("Hello 💚 I’m ElyBun. How are you feeling today?");
    //     });

    //     $botman->hears('sad|depressed', function (BotMan $bot) {
    //         $bot->reply("I'm really sorry you're feeling this way 💙  
    //         You're not alone. Would you like some calming tips or just want to talk?");
    //     });

    //     $botman->hears('happy|good', function (BotMan $bot) {
    //         $bot->reply("That’s lovely to hear 🌸 Keep holding onto that positivity!");
    //     });

    //     $botman->fallback(function (BotMan $bot) {
    //         $bot->reply("I'm here for you 🤍 You can tell me anything that's on your mind.");
    //     });

    //     $botman->listen();
    // }
    
public function handle(Request $request)
{
    $userMessage = $request->message;

    $botReply = "I hear you 💙 How are you feeling today?";

    ChatMessage::create([
        'user_message' => $userMessage,
        'bot_reply' => $botReply
    ]);

    return $botReply;
}
}

