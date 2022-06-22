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
    <div class="linksContainer">
        @canany(['agent', 'responsable'])
            <a class="buttonLinks" href="{{ route('stock.create') }}">Nouveau stock</a>
        @endcanany
    </div>
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
                @canany(['agent', 'responsable'])
                    <th></th>
                @endcan
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
                    @canany(['agent', 'responsable'])
                        <td class="tabButtonContainer">
                            <a class="buttonLinksTab" href="{{ route('stock.show', $stock->id) }}">Consulter</a>
                            <a class="buttonLinksTab" href="{{ route('stock.edit', $stock->id) }}">Modifier</a>
                            <a class="buttonLinksTab" href="{{ route('stock.destroy', $stock->id) }}">Supprimer</a>
                        </td>
                    @endcanany
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
