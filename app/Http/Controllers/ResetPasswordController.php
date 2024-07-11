<?php

namespace App\Http\Controllers;

use App\Mail\PasswordReset;
use App\Models\MailPasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function lupa_password()
    {
        return view('auth.lupa-password');
    }

    public function lupa_password_act(Request $request)
    {
        $customMessage = [
            'email.required'    => 'Email tidak boleh kosong',
            'email.email'       => 'Email tidak valid',
            'email.exists'      => 'Email tidak terdaftar di database',
        ];

        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], $customMessage);

        $token = Str::random(60);

        MailPasswordReset::updateOrCreate(
            [
                'email' => $request->email
            ],
            [
                'email' => $request->email,
                'token' => $token,
                'created_at' => now(),
            ]
        );

        $email = $request->email;

        Mail::to($request->email)->send(new PasswordReset($token, $email));

        return redirect()->route('lupa-password')->with('success', 'Kami telah mengirimkan link reset password ke email anda');
    }
    public function validasi_lupa_password_act(Request $request, $email)
    {
        $customMessage = [
            'password.required' => 'Password tidak boleh kosong',
            'password.min'      => 'Password minimal 6 karakter',
        ];

        $request->validate([
            'password' => 'required|min:6'
        ], $customMessage);

        $token = MailPasswordReset::where('token', $request->token)->first();

        if (!$token) {
            return redirect()->route('login')->with('failed', 'Token tidak valid');
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('login')->with('failed', 'Email tidak terdaftar di database');
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        $token->delete();

        return redirect()->route('login')->with('success', 'Password berhasil direset');
    }

    public function validasi_lupa_password(Request $request, $token, $email)
    {
        $gettoken = MailPasswordReset::where('token', $token)->where('email', $email)->first();
        if (!$gettoken) {
            return redirect()->route('login')->with('failed', 'Token tidak valid');
        }
        return view('auth.validasi-reset', compact('token', 'email'));
    }
}
