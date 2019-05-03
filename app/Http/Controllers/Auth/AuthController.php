<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Socialite;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Redirect the user to the Github authentication page
     *
     * @return Response
     */
    public function redirectToProvider($provider) {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Github
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        // Get github's user infomation
        $user = Socialite::driver($provider)->user();

        // Tạo user với các thông tin lấy được từ github
        $createdUser = User::firstOrCreate([
            'provider' => $provider,
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'avatar' => $user->getAvatar(),
            'provider_id' => $user->getId(),
            'token' => $user->token,
        ]);

        // Login với user vừa tạo.
        Auth::login($createdUser);

        return redirect('/');
    }
}
