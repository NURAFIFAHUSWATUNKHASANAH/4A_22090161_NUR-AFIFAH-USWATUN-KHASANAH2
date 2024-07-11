@extends('layouts.app')

@section('title', 'TOPSIS Result')

@section('content')
    <h1>TOPSIS Result</h1>

    <table>
        <thead>
            <tr>
                <th>Alternative</th>
                <th>Preference Value</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($preferenceValues as $alternative => $value)
                <tr>
                    <td>{{ $alternative }}</td>
                    <td>{{ $value }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
