@extends('layouts.app')

@section('title', 'Peringkat TOPSIS')

@section('content')
    <div class="container">
        <h1>Peringkat TOPSIS</h1>

        <table class="styled-table">
            <thead>
                <tr>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Nilai Preferensi (V)</th>
                    <th>Peringkat</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rankedResults as $result)
                    <tr>
                        <td>{{ $result->nip }}</td>
                        <td>{{ $result->nama }}</td>
                        <td>{{ $result->nilai_preferensi }}</td>
                        <td>{{ $result->ranking }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            <button onclick="printTable()" class="btn btn-primary" style="background-color: #F9D923;">Cetak Hasil</button>
        </div>
    </div>

    <script>
        function printTable() {
            window.print();
        }
    </script>
@endsection
