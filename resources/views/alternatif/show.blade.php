@extends('layouts.app')

@section('title', 'Detail Alternatif')

@section('content')
    <h1>Detail Alternatif</h1>

    <div class="form-group">
        <label>NIP:</label>
        <p>{{ $alternatif->nip }}</p>
    </div>

    <div class="form-group">
        <label>Nama:</label>
        <p>{{ $alternatif->nama }}</p>
    </div>

    <div class="form-group">
        <label>C1:</label>
        <p>{{ $alternatif->c1 }}</p>
    </div>

    <div class="form-group">
        <label>C2:</label>
        <p>{{ $alternatif->c2 }}</p>
    </div>

    <div class="form-group">
        <label>C3:</label>
        <p>{{ $alternatif->c3 }}</p>
    </div>

    <div class="form-group">
        <label>C4:</label>
        <p>{{ $alternatif->c4 }}</p>
    </div>

    <div class="form-group">
        <label>C5:</label>
        <p>{{ $alternatif->c5 }}</p>
    </div>

    <a href="{{ route('alternatif.index') }}" class="btn btn-add">Kembali</a>
@endsection
