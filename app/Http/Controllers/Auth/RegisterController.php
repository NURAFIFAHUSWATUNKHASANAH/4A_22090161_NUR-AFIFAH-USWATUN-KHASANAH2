<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,user', // pastikan validasi untuk role
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $token = Str::random(60);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->email_verification_token = $token;
        $user->save();

        $verificationUrl = url('/verify-email?token=' . $token);
        Mail::to($user->email)->send(new VerifyEmail($user->name, $verificationUrl));
        
        return redirect()->route('register')->with('success', 'Registration successful!');
    }

    public function verificationEmail(Request $request)
    {
        $token = $request->query('token');
        $user = User::where('email_verification_token', $token)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Token verifikasi tidak valid.');
        }

        $user->email_verified_at = now();
        $user->remember_token = Str::random(20);
        $user->save();

        return redirect()->route('login')->with('success', 'Email berhasil diverifikasi. Silakan login.');
    }
}
