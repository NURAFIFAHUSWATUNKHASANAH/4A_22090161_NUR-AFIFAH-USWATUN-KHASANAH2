@extends('layouts.app')

@section('title', 'Tambah Alternatif')

@section('content')
<h1>Tambah Alternatif</h1>

@if ($errors->any())
<div class="error-message">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('alternatif.store') }}" method="POST">
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
        <label for="c1">C1 (Kelengkapan Berkas):</label>
        <select id="c1" name="c1" required>
            <option value="10">Lengkap</option>
            <option value="7">Cukup Lengkap</option>
            <option value="5">Kurang Lengkap</option>
        </select>
    </div>

    <div class="form-group">
        <label for="c2">C2 (SKP 2 Tahun terakhir bernilai baik):</label>
        <select id="c2" name="c2" required>
            <option value="10">Sangat baik</option>
            <option value="8">Baik</option>
            <option value="6">Cukup</option>
        </select>
    </div>

    <div class="form-group">
        <label for="c3">C3 (Pendidikan Terakhir):</label>
        <select id="c3" name="c3" required>
            <option value="10">S3</option>
            <option value="9">S2</option>
            <option value="8">S1</option>
            <option value="7">D3</option>
        </select>
    </div>

    <div class="form-group">
        <label for="c4">C4 (4 Tahun Dalam Pangkat terakhir):</label>
        <select id="c4" name="c4" required>
            <option value="10">4th</option>
            <option value="8">5th – 6th</option>
            <option value="6">≥7th</option>
        </select>
    </div>

    <div class="form-group">
        <label for="c5">C5 (Kedisiplinan):</label>
        <select id="c5" name="c5" required>
            <option value="10">100-80</option>
            <option value="7">79-66</option>
            <option value="5">≤65</option>
        </select>
    </div>


    <div class="form-group">
        <label for="c5">C5:</label>
        <input type="number" id="c5" name="c5" value="{{ old('c5') }}" required>
    </div>

    <button type="submit" class="btn btn-add">Simpan</button>
</form>
@endsection