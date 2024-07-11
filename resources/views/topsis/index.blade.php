@extends('layouts.app')

@section('title', 'Hasil Perhitungan TOPSIS')

@section('content')
<h1>Hasil Perhitungan TOPSIS</h1>

<h2>Tabel Normalisasi</h2>
<table class="normalisasi-table">
    <thead>
        <tr>
            <th>NIP</th>
            <th>Nama</th>
            <th>C1</th>
            <th>C2</th>
            <th>C3</th>
            <th>C4</th>
            <th>C5</th>
        </tr>
    </thead>
    <tbody>
        @foreach($normalizedResults as $result)
        <tr>
            <td>{{ $result->nip }}</td>
            <td>{{ $result->nama }}</td>
            <td>{{ $result->c1 }}</td>
            <td>{{ $result->c2 }}</td>
            <td>{{ $result->c3 }}</td>
            <td>{{ $result->c4 }}</td>
            <td>{{ $result->c5 }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h2>Tabel Normalisasi Terbobot</h2>
<table class="normalisasi-table">
    <thead>
        <tr>
            <th>NIP</th>
            <th>Nama</th>
            <th>C1</th>
            <th>C2</th>
            <th>C3</th>
            <th>C4</th>
            <th>C5</th>
        </tr>
    </thead>
    <tbody>
        @foreach($weightedResults as $result)
        <tr>
            <td>{{ $result->nip }}</td>
            <td>{{ $result->nama }}</td>
            <td>{{ $result->c1 }}</td>
            <td>{{ $result->c2 }}</td>
            <td>{{ $result->c3 }}</td>
            <td>{{ $result->c4 }}</td>
            <td>{{ $result->c5 }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h2>Solusi Ideal (A+ dan A-)</h2>
<table class="normalisasi-table">
    <thead>
        <tr>
            <th>Kriteria</th>
            <th>Solusi Ideal Positif (A+)</th>
            <th>Solusi Ideal Negatif (A-)</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>C1</td>
            <td>{{ $idealPositive->values[0] }}</td>
            <td>{{ $idealNegative->values[0] }}</td>
        </tr>
        <tr>
            <td>C2</td>
            <td>{{ $idealPositive->values[1] }}</td>
            <td>{{ $idealNegative->values[1] }}</td>
        </tr>
        <tr>
            <td>C3</td>
            <td>{{ $idealPositive->values[2] }}</td>
            <td>{{ $idealNegative->values[2] }}</td>
        </tr>
        <tr>
            <td>C4</td>
            <td>{{ $idealPositive->values[3] }}</td>
            <td>{{ $idealNegative->values[3] }}</td>
        </tr>
        <tr>
            <td>C5</td>
            <td>{{ $idealPositive->values[4] }}</td>
            <td>{{ $idealNegative->values[4] }}</td>
        </tr>
    </tbody>
</table>

<h2>Jarak Solusi Ideal Positif (D+) dan Negatif (D-)</h2>
<table class="normalisasi-table">
    <thead>
        <tr>
            <th>NIP</th>
            <th>Nama</th>
            <th>D+</th>
            <th>D-</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rankedResults as $result)
        <tr>
            <td>{{ $result->nip }}</td>
            <td>{{ $result->nama }}</td>
            <td>{{ $result->jarak_positif }}</td>
            <td>{{ $result->jarak_negatif }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h2>Nilai Preferensi (V)</h2>
<table class="normalisasi-table">
    <thead>
        <tr>
            <th>NIP</th>
            <th>Nama</th>
            <th>Nilai Preferensi (V)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rankedResults as $result)
        <tr>
            <td>{{ $result->nip }}</td>
            <td>{{ $result->nama }}</td>
            <td>{{ $result->nilai_preferensi }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
