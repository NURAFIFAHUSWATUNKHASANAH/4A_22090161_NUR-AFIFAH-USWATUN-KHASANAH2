<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
{
    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        'current_password' => 'nullable|string|min:8',
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    // Mengambil pengguna yang sedang login
    $user = Auth::user();

    // Memperbarui informasi pengguna
    $user->name = $request->name;
    $user->email = $request->email;

    // Check if current password is provided and matches
    if ($request->filled('current_password')) {
        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'Password saat ini tidak cocok.',
            ]);
        }

        // Check if new password is provided and confirmed
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    }

    try {
        // Save the user
        $user->save();
    } catch (\Exception $e) {
        Log::error('Failed to update user: ' . $e->getMessage());
        return back()->withError('Failed to update profile: ' . $e->getMessage())->withInput();
    }

    // Redirect ke halaman profil dengan pesan sukses
    return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui.');
}}