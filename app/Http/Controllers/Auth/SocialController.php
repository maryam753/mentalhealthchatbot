<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class SocialController extends Controller
{
     public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();


        $user = User::where('email', $googleUser->getEmail())->first();

if ($user) {
    
    $user->update([
        'provider' => 'google',
        'provider_id' => $googleUser->getId(),
    ]);
} else {

    $user = User::create([
        'name' => $googleUser->getName(),
        'email' => $googleUser->getEmail(),
        'provider' => 'google',
        'provider_id' => $googleUser->getId(),
        'password' => bcrypt(Str::random(16)),
    ]);
}

        Auth::login($user);

        return redirect('/chat');
    }


}

