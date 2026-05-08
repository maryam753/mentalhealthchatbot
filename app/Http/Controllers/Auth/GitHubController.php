<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class GitHubController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->stateless()->redirect();
    }

    public function callback()
    {
  $githubUser = Socialite::driver('github')->stateless()->user();

        $user = User::updateOrCreate(
            [
                'email' => $githubUser->email,
            ],
            [
                'name' => $githubUser->name ?? $githubUser->nickname,
                'github_id' => $githubUser->id,
                'password' => bcrypt('password123'),
            ]
        );

        Auth::login($user);

        return redirect('/chat');
    }
}
