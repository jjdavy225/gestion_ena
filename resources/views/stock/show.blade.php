@extends('template.primary')

@section('titre')
    {{ $stock->code }}
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    <div class="tableShowContainer">
        <div>
            <h1>Infos</h1>
            <table class="table table-bordered">
                <tr>
                    <th>Numéro du stock</th>
                    <td>{{ $stock->code }}</td>
                </tr>
                <tr>
                    <th>Date de création stock</th>
                    <td>{{ $stock->jour }}</td>
                </tr>
                <tr>
                    <th>Nature du stock</th>
                    <td>{{ $stock->nature }}</td>
                </tr>
                <tr>
                    <th>Nombre d'entrées</th>
                    <td>{{ $stock->entree }}</td>
                </tr>
                <tr>
                    <th>Nombre de sorties</th>
                    <td>{{ $stock->sortie }}</td>
                </tr>
                <tr>
                    <th>Nombre de retours</th>
                    <td>{{ $stock->retour }}</td>
                </tr>
            </table>
        </div>
    </div>

    <h1>Contenu du stock</h1>
    <table class="table datatable">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Qte totale</th>
                <th>Qte entrée</th>
                <th>Qte sortie</th>
                <th>Qte retournée</th>
                <th>Désignation</th>
                <th>Marque</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1
            @endphp
            @foreach ($stock->articles as $article)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $article->code }}</td>
                    <td>{{ $article->pivot->quantite_totale }}</td>
                    <td>{{ $article->pivot->quantite_entree }}</td>
                    <td>{{ $article->pivot->quantite_sortie }}</td>
                    <td>{{ $article->pivot->quantite_retournee }}</td>
                    <td>{{ $article->designation }}</td>
                    <td>{{ $article->marque->designation }}</td>
                    <td>{{ $article->type->designation }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
