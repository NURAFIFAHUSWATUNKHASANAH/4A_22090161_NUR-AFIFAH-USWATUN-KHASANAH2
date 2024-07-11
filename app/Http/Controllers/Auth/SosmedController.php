<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SosmedController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $socialiteUser = Socialite::driver('google')->user();
            $email = $socialiteUser->getEmail();

            if ($email) {
                $existingUser = User::where('email', $email)->first();

                if ($existingUser) {
                    Auth::login($existingUser, true);

                    // Redirect based on role
                    return $this->redirectToRoleBasedPage($existingUser);
                } else {
                    // Create a new user with a random password
                    $newUser = User::create([
                        'name' => $socialiteUser->getName(),
                        'email' => $socialiteUser->getEmail(),
                        'created_at' => now(),
                        'remember_token' => Str::random(20),
                        'email_verified_at' => now(),
                        'role' => 'user',
                        'password' => Hash::make(Str::random(16)), // Generate a random password
                        // Add other user fields if necessary
                    ]);

                    Auth::login($newUser, true);

                    // Redirect to role selection page
                    return redirect()->route('select-role');
                }
            } else {
                // Handle the case where the email is not retrieved from the OAuth response
                return redirect()->route('login')->withErrors(['email' => 'Unable to retrieve email from Facebook.']);
            }
        } catch (\Exception $e) {
            // Handle any errors that occur during the OAuth process
            return redirect()->route('login')->withErrors(['email' => 'Internal Server Error. Please try again later.']);
        }
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $socialiteUser = Socialite::driver('facebook')->user();
            $email = $socialiteUser->getEmail();

            if ($email) {
                $existingUser = User::where('email', $email)->first();

                if ($existingUser) {
                    Auth::login($existingUser, true);

                    // Redirect based on role
                    return $this->redirectToRoleBasedPage($existingUser);
                } else {
                    // Create a new user with a random password
                    $newUser = User::create([
                        'name' => $socialiteUser->getName(),
                        'email' => $socialiteUser->getEmail(),
                        'created_at' => now(),
                        'remember_token' => Str::random(20),
                        'role' => 'user',
                        'password' => Hash::make(Str::random(16)), // Generate a random password
                        // Add other user fields if necessary
                    ]);

                    Auth::login($newUser, true);

                    // Redirect to role selection page
                    return redirect()->route('select-role');
                }
            } else {
                // Handle the case where the email is not retrieved from the OAuth response
                return redirect()->route('login')->withErrors(['email' => 'Unable to retrieve email from Facebook.']);
            }
        } catch (\Exception $e) {
            // Handle any errors that occur during the OAuth process
            return redirect()->route('login')->withErrors(['email' => 'Internal Server Error. Please try again later.']);
        }
    }

    protected function redirectToRoleBasedPage($user)
    {
        switch ($user->role) {
            case 'admin':
                return redirect('/admin');
            case 'user':
                return redirect('/user');
                // Add more roles as needed
            default:
                return redirect()->intended('/home');
        }
    }
}
