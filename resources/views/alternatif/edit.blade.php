@extends('layouts.app')

@section('title', 'Edit Alternatif')

@section('content')
    <h1>Edit Alternatif</h1>

    @if ($errors->any())
        <div class="error-message">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('alternatif.update', $alternatif->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nip">NIP:</label>
            <input type="text" id="nip" name="nip" value="{{ $alternatif->nip }}" readonly class="readonly-field">
        </div>

        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="{{ $alternatif->nama }}" readonly class="readonly-field">
        </div>

        <div class="form-group">
            <label for="c1">C1 (Kelengkapan Berkas):</label>
            <select id="c1" name="c1" required>
                <option value="10" {{ $alternatif->c1 == 10 ? 'selected' : '' }}>Lengkap</option>
                <option value="7" {{ $alternatif->c1 == 7 ? 'selected' : '' }}>Cukup Lengkap</option>
                <option value="5" {{ $alternatif->c1 == 5 ? 'selected' : '' }}>Kurang Lengkap</option>
            </select>
        </div>

        <div class="form-group">
            <label for="c2">C2 (SKP 2 Tahun terakhir bernilai baik):</label>
            <select id="c2" name="c2" required>
                <option value="10" {{ $alternatif->c2 == 10 ? 'selected' : '' }}>Sangat baik</option>
                <option value="8" {{ $alternatif->c2 == 8 ? 'selected' : '' }}>Baik</option>
                <option value="6" {{ $alternatif->c2 == 6 ? 'selected' : '' }}>Cukup</option>
            </select>
        </div>

        <div class="form-group">
            <label for="c3">C3 (Pendidikan Terakhir):</label>
            <select id="c3" name="c3" required>
                <option value="10" {{ $alternatif->c3 == 10 ? 'selected' : '' }}>S3</option>
                <option value="9" {{ $alternatif->c3 == 9 ? 'selected' : '' }}>S2</option>
                <option value="8" {{ $alternatif->c3 == 8 ? 'selected' : '' }}>S1</option>
                <option value="7" {{ $alternatif->c3 == 7 ? 'selected' : '' }}>D3</option>
            </select>
        </div>

        <div class="form-group">
            <label for="c4">C4 (4 Tahun Dalam Pangkat terakhir):</label>
            <select id="c4" name="c4" required>
                <option value="10" {{ $alternatif->c4 == 10 ? 'selected' : '' }}>4th</option>
                <option value="8" {{ $alternatif->c4 == 8 ? 'selected' : '' }}>5th – 6th</option>
                <option value="6" {{ $alternatif->c4 == 6 ? 'selected' : '' }}>≥7th</option>
            </select>
        </div>

        <div class="form-group">
            <label for="c5">C5 (Kedisiplinan):</label>
            <select id="c5" name="c5" required>
                <option value="10" {{ $alternatif->c5 == 10 ? 'selected' : '' }}>100-80</option>
                <option value="7" {{ $alternatif->c5 == 7 ? 'selected' : '' }}>79-66</option>
                <option value="5" {{ $alternatif->c5 == 5 ? 'selected' : '' }}>≤65</option>
            </select>
        </div>

        <button type="submit" class="btn btn-add">Simpan</button>
    </form>
@endsection

<style>
    .readonly-field {
    color: rgba(0, 0, 0, 0.5); /* Mengatur warna teks menjadi gelap */
}

</style>