@extends('template.primary')

@section('titre')
    Marques des articles
@endsection

@section('contenu')
    @if (Session::has('info'))
        <div class="alert alert-primary">
            {{ Session::get('info') }}
        </div>
    @endif
    @canany(['agent', 'responsable'])
        <a class="buttonLinks" href="{{ route('marque_article.create') }}">Nouvelle marque</a>
    @endcanany
    <h1>Liste des marques des articles</h1>
    <table class="table table-success table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Désignation</th>
                @canany(['agent', 'responsable'])
                    <th></th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach ($marques as $marque)
                <tr>
                    <td>{{ $marque->id }}</td>
                    <td>{{ $marque->code }}</td>
                    <td>{{ $marque->designation }}</td>
                    @canany(['agent', 'responsable'])
                        <td class="tabButtonContainer">
                            <a class="buttonLinksTab" href="{{ route('marque_article.edit', $marque->id) }}">Modifier</a>
                            <a class="buttonLinksTab" href="{{ route('marque_article.destroy', $marque->id) }}">Supprimer</a>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
