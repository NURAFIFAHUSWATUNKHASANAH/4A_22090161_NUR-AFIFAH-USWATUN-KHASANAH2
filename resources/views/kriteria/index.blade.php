@extends('layouts.app')

@section('title', 'Daftar Kriteria')

@section('content')
<div class="container">
    <h1>Daftar Kriteria</h1>

    @if (auth()->user()->isAdmin())
        <div style="margin-bottom: 15px;">
            <a href="{{ route('kriteria.create') }}" class="btn btn-add mb-3">Tambah Kriteria</a>
        </div>
    @endif

    <table class="styled-table">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Atribut</th>
                <th>Bobot</th>
                <th>Nama Kriteria</th>
                @if (auth()->user()->isAdmin())
                    <th>Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if ($kriteria !== null && count($kriteria) > 0)
                @foreach ($kriteria as $item)
                    <tr>
                        <td>{{ $item->kode }}</td>
                        <td>{{ $item->atribut }}</td>
                        <td>{{ $item->bobot }}</td>
                        <td>{{ $item->nama_kriteria }}</td>
                        @if (auth()->user()->isAdmin())
                            <td>
                                <a href="{{ route('kriteria.edit', $item->id) }}" class="btn btn-edit">Edit</a>
                                <form action="{{ route('kriteria.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus?')" class="btn btn-delete">Hapus</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" style="text-align: center;">Tidak ada kriteria.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
