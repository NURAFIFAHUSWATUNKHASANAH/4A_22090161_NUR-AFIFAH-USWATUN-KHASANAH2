<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function selectRole()
    {
        return view('auth.select-role');
    }
    public function storeRole(Request $request)
    {
        $request->validate([
            'role' => 'required|string'
        ]);
        $tokenVerif = Str::random(30);

        $user = User::where('id', Auth::id())->first();
        $user->role = $request->role;
        $user->email_verified_at = now();
        $user->email_verification_token = $tokenVerif;
        $user->save();

        // Redirect based on role
        return $this->redirectToRoleBasedPage($user);
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
