@extends('layouts.app')

@section('title', 'Edit Kriteria')

@section('content')
    <h1>Edit Kriteria</h1>

    <form action="{{ route('kriteria.update', $kriteria->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="kode">Kode:</label>
            <input type="text" id="kode" name="kode" value="{{ $kriteria->kode }}" required>
        </div>

        <div class="form-group">
            <label for="atribut">Atribut:</label>
            <select id="atribut" name="atribut" required>
                <option value="benefit" {{ $kriteria->atribut == 'benefit' ? 'selected' : '' }}>Benefit</option>
                <option value="cost" {{ $kriteria->atribut == 'cost' ? 'selected' : '' }}>Cost</option>
            </select>
        </div>

        <div class="form-group">
            <label for="bobot">Bobot:</label>
            <select id="bobot" name="bobot" required>
                <option value="1" {{ $kriteria->bobot == 1 ? 'selected' : '' }}>Sangat Rendah</option>
                <option value="2" {{ $kriteria->bobot == 2 ? 'selected' : '' }}>Rendah</option>
                <option value="3" {{ $kriteria->bobot == 3 ? 'selected' : '' }}>Cukup</option>
                <option value="4" {{ $kriteria->bobot == 4 ? 'selected' : '' }}>Tinggi</option>
                <option value="5" {{ $kriteria->bobot == 5 ? 'selected' : '' }}>Sangat Tinggi</option>
            </select>
        </div>

        <div class="form-group">
            <label for="nama_kriteria">Nama Kriteria:</label>
            <input type="text" id="nama_kriteria" name="nama_kriteria" value="{{ $kriteria->nama_kriteria }}" required>
        </div>

        <button type="submit" class="btn btn-add mb-3">Simpan</button>
    </form>
@endsection
