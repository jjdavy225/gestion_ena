@extends('template.primary')

@section('titre')
    {{ $inventaire->code }}
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
                    <th>Code de l'inventaire</th>
                    <td>{{ $inventaire->code }}</td>
                </tr>
                <tr>
                    <th>Date de réalisation de l'inventaire</th>
                    <td>{{ $inventaire->created_at }}</td>
                </tr>
                <tr>
                    <th>Nature de l'inventaire</th>
                    <td>{{ $inventaire->nature }}</td>
                </tr>
            </table>
        </div>
    </div>
    <h1>Les articles inventoriés</h1>
    <table class="table datatable">
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
            @php
                $i = 1;
            @endphp
            @foreach ($inventaire->articles as $article)
                <tr>
                    <td>{{ $i++ }}</td>
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
@endsection
