@extends('layouts.app')

@section('title', 'Edit Pegawai')

@section('content')
<div class="container">
    <h1>Edit Pegawai</h1>
    <form action="{{ route('daftar_pegawai.update', $pegawai->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $pegawai->nama }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" class="form-control" id="nip" name="nip" value="{{ $pegawai->nip }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="laki-laki" {{ $pegawai->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="perempuan" {{ $pegawai->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $pegawai->alamat }}" required>
        </div>
        <button type="submit" class="btn btn-update">Update</button>
    </form>
</div>
@endsection
