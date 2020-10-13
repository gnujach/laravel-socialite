<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Auth;
use Hash;
use Exception;
use Str;


class AuthGithubController extends Controller
{
    public function github()
    {

        return Socialite::driver('github')->redirect();
    }
    public function  githubRedirect()
    {
        try {
            $user = Socialite::driver('github')->stateless()->user();
            $finduser = User::where('email', $user->email)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect('/dashboard');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => Hash::make(Str::random(24)),

                ]);
                Auth::login($newUser);

                return redirect('/dashboard');
            }
        } catch (Exception $e) {
            dd($e);
        }
    }
}
