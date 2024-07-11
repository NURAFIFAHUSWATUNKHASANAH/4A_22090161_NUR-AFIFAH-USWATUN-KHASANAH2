@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Kelola Akun</h1>

    <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
            <form action="{{ route('profile.update') }}" method="POST" class="edit-profile-form">
                @csrf
                @method('PUT')

                <!-- Profile Information -->
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Change Section -->
                 <p> *Apabila tidak ingin mengganti password, cukup masukan nama dan email saja jika ingin mengganti salah satunya </p>
                <div class="form-group">
                    <label for="current_password">Password Saat Ini</label>
                    <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror">
                    @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password Baru</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection

<style>
    .edit-profile-form {
        max-width: 600px;
        margin: auto;
    }

    .edit-profile-form .form-group {
        margin-bottom: 20px;
    }

    .edit-profile-form label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .edit-profile-form input[type="text"],
    .edit-profile-form input[type="email"],
    .edit-profile-form input[type="password"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }

    .edit-profile-form .invalid-feedback {
        display: block;
        color: red;
        margin-top: 5px;
    }

    .edit-profile-form button {
        display: block;
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: none;
        border-radius: 4px;
        background-color: #F9D923;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .edit-profile-form button:hover {
        background-color: #D9CE3F;
    }
</style>
