<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use BotMan\BotMan\BotManFactory;
use BotMan\Drivers\Web\WebDriver;
use BotMan\BotMan\Drivers\DriverManager;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\Auth\GitHubController;

Route::post('/rename-thread', [ChatController::class, 'renameThread']);
Route::post('/delete-thread', [ChatController::class, 'deleteThread']);
Route::get('/auth/github', [GitHubController::class, 'redirect'])
    ->name('github.login');
Route::get('/auth/github/callback', [GitHubController::class, 'callback']);
Route::post('/save-mood', [ChatController::class, 'saveMood']);
Route::get('/get-moods', [ChatController::class, 'getMoods']);
Route::get('/auth/google', [SocialController::class, 'redirect']);
Route::get('/auth/google/callback', [SocialController::class, 'callback']);
Route::post('/send-message', [ChatController::class, 'sendMessage']);
Route::post('/new-chat', [ChatController::class, 'newChat']);
Route::get('/chat-history', [ChatController::class, 'chatHistory']);
Route::get('/recent-threads', [ChatController::class, 'recentThreads']);

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('index');
});
Route::middleware(['web'])->group(function () {

    Route::get('/chat', function () {
        return view('chat');
    });

    Route::match(['get', 'post'], '/botman', function () {

        $botman = \BotMan\BotMan\BotManFactory::create([]);
           $botman->hears('helpline', function ($bot) {
        $bot->reply("🆘 You can open the Helplines section from the sidebar. You deserve support 🤍");
    });

        $botman->hears('{message}', function ($bot, $message) {
            $gemini = new \App\Services\GeminiService();
            $reply = $gemini->generateResponse($message);
            $bot->reply($reply);
        });

        $botman->listen();
    });

});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


