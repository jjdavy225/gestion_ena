@extends('template.primary')

@section('titre')
    Bureau {{ $patrimoine->first()->bureau->site->designation }}
    -{{ $patrimoine->first()->bureau->designation }}
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    <h1>Infos</h1>
    <ul class="show">
        <li>Nom du bureau : {{ $patrimoine->first()->bureau->site->designation }}
            -{{ $patrimoine->first()->bureau->designation }}</li>
        <li>Nombre d'articles différents : {{ $patrimoine->count() }}</li>
    </ul>
    <h4>Contenu du bureau</h4>
    <table class="table table-success table-stripped">
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
                    <td>{{ $i }}</td>
                    <td>{{ $articleP->article->code }}</td>
                    <td>{{ $articleP->quantite }}</td>
                    <td>{{ $articleP->article->designation }}</td>
                    <td>{{ $articleP->article->marque->designation }}</td>
                    <td>{{ $articleP->article->type->designation }}</td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
        </tbody>
    </table>
    <button><a href="{{ route('patrimoine.index') }}">Retour</a></button>
@endsection
