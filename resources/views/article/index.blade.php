@extends('template.primary')

@section('titre')
    Liste des articles
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
                <th>Désignation</th>
                <th>Marque</th>
                <th>Type</th>
                {{-- <th></th> --}}
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->code }}</td>
                    <td>{{ $article->designation }}</td>
                    <td>{{ $article->marque->designation }}</td>
                    <td>{{ $article->type->designation }}</td>
                    {{-- <td><a href="{{ route('article.show', $article->id) }}">Voir</a></td> --}}
                    <td><a href="{{ route('article.edit', $article->id) }}">Modifier</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h4>Enregistrer un nouvel article <a href="{{ route('article.create') }}">ici!</a></h4>
@endsection
