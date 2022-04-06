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
    <h1>Liste des marques des articles</h1>
    <table class="table table-success table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Désignation</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($marques as $marque)
                <tr>
                    <td>{{ $marque->id }}</td>
                    <td>{{ $marque->code }}</td>
                    <td>{{ $marque->designation }}</td>
                    <td><a href="{{ route('marque_article.edit', $marque->id) }}">Modifier</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h4>Enregistrer une nouvelle marque <a href="{{ route('marque_article.create') }}">ici!</a></h4>
@endsection
