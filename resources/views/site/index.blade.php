@extends('template.primary')

@section('titre')
    Liste des sites
@endsection

@section('contenu')
    @if (Session::has('info'))
        <div class="alert alert-primary">
            {{ Session::get('info') }}
        </div>
    @endif
    <h1>Liste des sites</h1>
    <table class="table table-success table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Désignation</th>
                {{-- <th></th> --}}
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sites as $site)
                <tr>
                    <td>{{ $site->id }}</td>
                    <td>{{ $site->code }}</td>
                    <td>{{ $site->designation }}</td>
                    {{-- <td><a href="{{ route('site.show', $site->id) }}">Voir</a></td> --}}
                    <td><a href="{{ route('site.edit', $site->id) }}">Modifier</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h4>Enregistrer un nouveau site <a href="{{ route('site.create') }}">ici!</a></h4>
@endsection
