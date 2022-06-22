@extends('template.primary')

@section('titre')
    Types d'articles
@endsection

@section('contenu')
    @if (Session::has('info'))
        <div class="alert alert-primary">
            {{ Session::get('info') }}
        </div>
    @endif
    @canany(['agent', 'responsable'])
        <a class="buttonLinks" href="{{ route('type_article.create') }}">Nouveau type</a>
    @endcanany
    <h1>Liste des types des articles</h1>
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
            @foreach ($types as $type)
                <tr>
                    <td>{{ $type->id }}</td>
                    <td>{{ $type->code }}</td>
                    <td>{{ $type->designation }}</td>
                    @canany(['agent', 'responsable'])
                        <td class="tabButtonContainer">
                            <a class="buttonLinksTab" href="{{ route('type_article.edit', $type->id) }}">Modifier</a>
                            <a class="buttonLinksTab" href="{{ route('type_article.destroy', $type->id) }}">Supprimer</a>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
