@extends('template.primary')

@section('titre')
    Bureau {{ $patrimoine->first()->bureau->site->designation }}
    -{{ $patrimoine->first()->bureau->designation }}
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    <h1>Contenu du bureau</h1>
    <table class="table datatable">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Quantité</th>
                <th>Désignation</th>
                <th>Marque</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($patrimoine as $articleP)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $articleP->article->code }}</td>
                    <td>{{ $articleP->quantite }}</td>
                    <td>{{ $articleP->article->designation }}</td>
                    <td>{{ $articleP->article->marque->designation }}</td>
                    <td>{{ $articleP->article->type->designation }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
