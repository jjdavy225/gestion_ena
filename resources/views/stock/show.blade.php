@extends('template.primary')

@section('titre')
    {{ $stock->code }}
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ secure_asset('css/style1.css') }}">
@endsection

@section('contenu')
    <h1>Infos</h1>
    <ul class="show">
        <li>Numéro du stock : {{ $stock->code }}</li>
        <li>Date de création du stock : {{ $stock->jour }}</li>
        <li>Nature du stock : {{ $stock->nature }}</li>
        <li>Nombre d'entrées : {{ $stock->entree }}</li>
        <li>Nombre de retours : {{ $stock->retour }}</li>
        <li>Nombre de sorties : {{ $stock->sortie }}</li>
    </ul>
    <h4>Contenu du stock</h4>
    <table class="table table-success table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Quantité</th>
                <th>Mouvement</th>
                <th>Désignation</th>
                <th>Marque</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stock->articles as $article)
                <tr>
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->code }}</td>
                    <td>{{ $article->pivot->quantite_article }}</td>
                    <td>{{ $article->pivot->mouvement }}</td>
                    <td>{{ $article->designation }}</td>
                    <td>{{ $article->marque->designation }}</td>
                    <td>{{ $article->type->designation }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button><a href="{{ route('stock.index') }}">Retour</a></button>
@endsection
