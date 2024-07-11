@extends('layouts.app')

@section('title', 'Data Alternatif')

@section('content')
    <h1>Data Alternatif</h1>

    @if(Session::has('success'))
        <div class="success-message">{{ Session::get('success') }}</div>
    @endif

    <div class="mb-3" style="float: right; margin-bottom: 15px;">
        <input type="text" id="searchInput" placeholder="Cari NIP atau Nama..." style="width: 200px;">
        <button type="button" class="btn btn-search" onclick="search()">Cari</button>
    </div>

    @if ($alternatif->isEmpty())
        <p>Tidak ada data alternatif.</p>
    @else
        <table class="table styled-table">
            <thead>
                <tr>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>C1</th>
                    <th>C2</th>
                    <th>C3</th>
                    <th>C4</th>
                    <th>C5</th>
                    @if (auth()->user()->isAdmin())
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody id="tableBody">
                @foreach ($alternatif as $item)
                    <tr>
                        <td>{{ $item->nip }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->c1 }}</td>
                        <td>{{ $item->c2 }}</td>
                        <td>{{ $item->c3 }}</td>
                        <td>{{ $item->c4 }}</td>
                        <td>{{ $item->c5 }}</td>
                        @if (auth()->user()->isAdmin())
                            <td>
                                <a href="{{ route('alternatif.edit', $item->id) }}" class="btn btn-edit">Edit</a>
                                <form action="{{ route('alternatif.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">Hapus</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function search() {
            var searchText = $('#searchInput').val().toLowerCase();
            $.ajax({
                url: '/search', // Rute untuk menangani permintaan pencarian
                method: 'GET',
                data: {
                    query: searchText // Mengirim kata kunci pencarian ke server
                },
                success: function(response) {
                    var tbody = '';
                    response.forEach(function(pegawai) {
                        tbody += '<tr>' +
                            '<td>' + (pegawai.nip ? pegawai.nip : '') + '</td>' + // Periksa jika properti nip ada
                            '<td>' + (pegawai.nama ? pegawai.nama : '') + '</td>' + // Periksa jika properti nama ada
                            '<td>' + (pegawai.c1 ? pegawai.c1 : '') + '</td>' + // Periksa jika properti c1 ada
                            '<td>' + (pegawai.c2 ? pegawai.c2 : '') + '</td>' + // Periksa jika properti c2 ada
                            '<td>' + (pegawai.c3 ? pegawai.c3 : '') + '</td>' + // Periksa jika properti c3 ada
                            '<td>' + (pegawai.c4 ? pegawai.c4 : '') + '</td>' + // Periksa jika properti c4 ada
                            '<td>' + (pegawai.c5 ? pegawai.c5 : '') + '</td>'; // Periksa jika properti c5 ada
                        if (pegawai.id) {
                            tbody += '<td><a href="{{ route("alternatif.edit", ":id") }}" class="btn btn-edit">Edit</a></td>'.replace(':id', pegawai.id);
                        }
                        tbody += '</tr>';
                    });
                    $('#tableBody').html(tbody); // Memperbarui isi tabel dengan hasil pencarian yang diterima dari server
                }
            });
        }
    </script>
@endsection
