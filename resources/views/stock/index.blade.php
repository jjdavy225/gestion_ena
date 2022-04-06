@extends('template.primary')

@section('titre')
    Liste des STOCKS
@endsection

@section('contenu')
    @if (Session::has('info'))
        <div class="alert alert-primary">
            {{ Session::get('info') }}
        </div>
    @endif
    <h1>Liste des articles</h1>
    <table class="table table-success table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Nature</th>
                <th>Nb d'articles en stock</th>
                <th>Nb d'entrées</th>
                <th>Nb de sorties</th>
                <th>Nb de retours</th>
                <th>Jour</th>
                <th></th>
                <th></th>

            </tr>
        </thead>
        <tbody>
            @foreach ($stocks as $stock)
                <tr>
                    <td>{{ $stock->id }}</td>
                    <td>{{ $stock->code }}</td>
                    <td>{{ $stock->nature }}</td>
                    <td>{{ $stock->stock }}</td>
                    <td>{{ $stock->entree }}</td>
                    <td>{{ $stock->sortie }}</td>
                    <td>{{ $stock->retour }}</td>
                    <td>{{ $stock->jour }}</td>
                    <td><a href="{{ route('stock.show', $stock->id) }}">Consulter</a></td>
                    <td><a href="{{ route('stock.edit', $stock->id) }}">Modifier</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h4>Enregistrer un nouveau stock <a href="{{ route('stock.create') }}">ici!</a></h4>
@endsection
