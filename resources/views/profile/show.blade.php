@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Akun Saya</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div style="color: white;" class="card-header">Informasi Akun</div>
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Masuk Sebagai:</strong> {{ ucfirst($user->role) }}</p>
            <a href="{{ route('profile.edit') }}" class="btn btn-add">Edit</a>
        </div>
    </div>
</div>

<style>
    .container {
        margin-top: 20px;
    }

    .card {
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    .card-header {
        background-color: #890F0D;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
        padding: 15px;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    .card-body {
        padding: 15px;
    }

    .alert-success {
        margin-top: 20px;
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
        padding: 10px 20px;
        border-radius: 4px;
    }
</style>
@endsection
