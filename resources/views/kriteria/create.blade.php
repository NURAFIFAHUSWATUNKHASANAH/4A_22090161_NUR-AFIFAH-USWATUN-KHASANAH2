<!-- resources/views/kriteria/create.blade.php -->

@extends('layouts.app')

@section('title', 'Tambah Kriteria')

@section('content')
    <h1>Tambah Kriteria</h1>

    <form action="{{ route('kriteria.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="kode">Kode:</label>
            <input type="text" id="kode" name="kode" value="{{ old('kode') }}" required>
        </div>

        <div class="form-group">
            <label for="nama_kriteria">Nama Kriteria:</label>
            <input type="text" id="nama_kriteria" name="nama_kriteria" value="{{ old('nama_kriteria') }}" required>
        </div>

        <div class="form-group">
            <label for="atribut">Atribut:</label>
            <select id="atribut" name="atribut" required>
                <option value="benefit">Benefit</option>
                <option value="cost">Cost</option>
            </select>
        </div>

        <div class="form-group">
            <label for="bobot">Bobot:</label>
            <select id="bobot" name="bobot" required>
                <option value="1">Sangat Rendah</option>
                <option value="2">Rendah</option>
                <option value="3">Cukup</option>
                <option value="4">Tinggi</option>
                <option value="5">Sangat Tinggi</option>
            </select>
        </div>

        <button type="submit">Simpan</button>
    </form>
@endsection
