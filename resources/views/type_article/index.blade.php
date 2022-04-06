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
    <h1>Liste des types des articles</h1>
    <table class="table table-success table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($types as $type)
                <tr>
                    <td>{{ $type->id }}</td>
                    <td>{{ $type->code }}</td>
                    <td>{{ $type->designation }}</td>
                    <td><a href="{{ route('type_article.edit', $type->id) }}">Modifier</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h4>Enregistrer un nouveau type <a href="{{ route('type_article.create') }}">ici!</a></h4>
@endsection
