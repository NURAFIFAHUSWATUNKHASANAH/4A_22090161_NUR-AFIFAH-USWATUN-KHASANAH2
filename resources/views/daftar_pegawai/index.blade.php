@extends('layouts.app')

@section('title', 'Daftar Pegawai')

@section('content')
<div class="container">
    <h1>Daftar Pegawai</h1>

    <a href="{{ route('daftar_pegawai.create') }}" class="btn btn-add mb-3">Tambah Pegawai</a>
    <div class="mb-3" style="float: right; margin-top: 20px; margin-bottom: 20px;">
        <input type="text" id="searchInput" placeholder="Cari Pegawai..." style="width: 150px;">
    </div>
    <div class="mb-3" style="float: right; margin-top: 20px; margin-bottom: 20px; margin-right: 10px;">
        <select id="rowsPerPageSelect" class="form-select">
            <option value="3">1-3</option>
            <option value="5">1-5</option>
            <option value="10" selected>1-10</option>
            <option value="50">1-50</option>
            <option value="100">1-100</option>
            <option value="all">All</option>
        </select>
    </div>
</div>

<div class="table-responsive">
    <table class="table styled-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIP</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pegawai as $p)
                <tr>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->nip }}</td>
                    <td>{{ $p->jenis_kelamin }}</td>
                    <td>{{ $p->alamat }}</td>
                    <td>
                        <a href="{{ route('daftar_pegawai.edit', $p->id) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('daftar_pegawai.destroy', $p->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div>
    <button id="prevPage" class="btn btn-secondary">Previous</button>
    <button id="nextPage" class="btn btn-secondary">Next</button>
</div>

<p id="rowCount">Menampilkan 1-{{ count($pegawai) }} dari {{ count($pegawai) }} data</p>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        var currentPage = 1;
        var rowsPerPage = $('#rowsPerPageSelect').val() === 'all' ? 'all' : parseInt($('#rowsPerPageSelect').val());
        var totalRows = {{ count($pegawai) }};

        function updateTable(rows) {
            var tbody = '';
            var start = (currentPage - 1) * rowsPerPage;
            var end = start + rowsPerPage;
            if (rowsPerPage === 'all') {
                visibleRows = rows;
                start = 1;
                end = rows.length;
            } else {
                visibleRows = rows.slice(start, end);
            }

            visibleRows.forEach(function(pegawai){
                tbody += '<tr>' +
                    '<td>' + pegawai.nama + '</td>' +
                    '<td>' + pegawai.nip + '</td>' +
                    '<td>' + pegawai.jenis_kelamin + '</td>' +
                    '<td>' + pegawai.alamat + '</td>' +
                    '<td>' +
                    '<a href="{{ route("daftar_pegawai.edit", ":id") }}" class="btn btn-edit">Edit</a>'.replace(':id', pegawai.id) +
                    '<form action="{{ route("daftar_pegawai.destroy", ":id") }}" method="POST" style="display:inline-block;">' +
                    '@csrf' +
                    '@method("DELETE")' +
                    '<button type="submit" class="btn btn-delete">Hapus</button>' +
                    '</form>' +
                    '</td>' +
                    '</tr>';
            });
            $('tbody').html(tbody);
            updateRowCount(rows.length);
        }

        function updateRowCount(totalRows) {
            var start = (currentPage - 1) * (rowsPerPage === 'all' ? totalRows : rowsPerPage) + 1;
            var end = start + $('tbody tr').length - 1;
            $('#rowCount').text('Menampilkan ' + start + '-' + end + ' dari ' + totalRows + ' data');
        }

        $('#rowsPerPageSelect').on('change', function(){
            rowsPerPage = $(this).val() === 'all' ? 'all' : parseInt($(this).val());
            currentPage = 1; // Reset to first page on rows per page change
            $('#searchInput').trigger('keyup');
        });

        $('#searchInput').on('keyup', function(){
            var searchText = $(this).val().toLowerCase();
            $.ajax({
                url: '{{ route("search") }}',
                method: 'GET',
                data: {
                    query: searchText
                },
                success: function(response){
                    currentPage = 1; // Reset to first page on search
                    updateTable(response);
                    $('#prevPage').prop('disabled', currentPage === 1);
                    $('#nextPage').prop('disabled', response.length <= rowsPerPage && rowsPerPage !== 'all');
                }
            });
        });

        $('#prevPage').on('click', function(){
            if (currentPage > 1) {
                currentPage--;
                $('#searchInput').trigger('keyup');
                $('#nextPage').prop('disabled', false);
            }
            $('#prevPage').prop('disabled', currentPage === 1);
        });

        $('#nextPage').on('click', function(){
            currentPage++;
            $('#searchInput').trigger('keyup');
            $('#prevPage').prop('disabled', false);
        });

        // Initial count
        updateRowCount(totalRows);
    });
</script>
