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

class AuthAzureController extends Controller
{
    public function azure()
    {

        return Socialite::driver('azure')->redirect();
    }
    public function  azureRedirect()
    {
        try {
            $user = Socialite::driver('azure')->stateless()->user();
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
