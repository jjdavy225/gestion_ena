@extends('template.primary')

@section('titre')
    Liste des bureaux
@endsection

@section('contenu')
    @if (Session::has('info'))
        <div class="alert alert-primary">
            {{ Session::get('info') }}
        </div>
    @endif
    <h1>Liste des bureaux</h1>
    <table class="table table-success table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Désignation</th>
                <th>Site</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bureaux as $bureau)
                <tr>
                    <td>{{ $bureau->id }}</td>
                    <td>{{ $bureau->code }}</td>
                    <td>{{ $bureau->designation }}</td>
                    <td>{{ $bureau->site->designation }}</td>
                    <td><a href="{{ route('bureau.edit', $bureau->id) }}">Modifier</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h4>Enregistrer un nouveau bureau <a href="{{ route('bureau.create') }}">ici!</a></h4>
@endsection
