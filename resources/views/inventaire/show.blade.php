@extends('template.primary')

@section('titre')
    {{ $inventaire->code }}
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ secure_asset('css/style1.css') }}">
@endsection

@section('contenu')
    <h1>Infos</h1>
    <ul class="show">
        <li>Code de l'inventaire : {{ $inventaire->code }}</li>
        <li>Date de réalisation inventaire : {{ $inventaire->created_at }}</li>
        <li>Nature du inventaire : {{ $inventaire->nature }}</li>
    </ul>
    <h4>Les articles inventoriés</h4>
    <table class="table table-success table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Quantité</th>
                <th>Nature du stock</th>
                <th>Désignation</th>
                <th>Marque</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inventaire->articles as $article)
                <tr>
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->code }}</td>
                    <td>{{ $article->pivot->quantite }}</td>
                    <td>{{ $article->pivot->nature_stock }}</td>
                    <td>{{ $article->designation }}</td>
                    <td>{{ $article->marque->designation }}</td>
                    <td>{{ $article->type->designation }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button><a href="{{ route('inventaire.index') }}">Retour</a></button>
@endsection
