<!-- resources/views/employees/create.blade.php -->

@extends('layouts.app')

@section('title', 'Tambah Pegawai')

@section('content')
    <h1>Tambah Pegawai</h1>

    @if ($errors->any())
        <div class="error-message">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(Session::has('success'))
        <div class="success-message">{{ Session::get('success') }}</div>
    @endif

    <form action="{{ route('daftar_pegawai.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nip">NIP:</label>
            <input type="text" id="nip" name="nip" value="{{ old('nip') }}" required>
        </div>

        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required>
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <textarea id="alamat" name="alamat" required>{{ old('alamat') }}</textarea>
        </div>

        <button type="submit" class="btn btn-add">Simpan</button>
    </form>
    
@endsection

<!-- <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .content {
        max-width: 700px;
        width: 90%;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #A91D3A;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #333;
    }

    input[type="text"],
    select,
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
        box-sizing: border-box;
    }

    textarea {
        resize: vertical;
        height: 100px;
    }

    .btn.btn-add {
        display: block;
        width: 100%;
        padding: 10px 0;
        font-size: 18px;
        color: #fff;
        background-color: #A91D3A;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 20px;
    }

    .btn.btn-add:hover {
        background-color: #8b1a30;
    }

    .error-message,
    .success-message {
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 4px;
        font-size: 16px;
        box-sizing: border-box;
    }

    .error-message {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .success-message {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
</style> -->
