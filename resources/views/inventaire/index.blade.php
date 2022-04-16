@extends('template.primary')

@section('titre')
    Inventaire
@endsection

@section('contenu')
    @if (Session::has('info'))
        <div class="alert alert-primary">
            {{ Session::get('info') }}
        </div>
    @endif
    <h1>Liste des inventaires</h1>
    <div class="container">
        <table class="table table-success table-stripped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Jour et heure</th>
                    <th>Nature</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inventaires as $inventaire)
                    <tr>
                        <td>{{ $inventaire->id }}</td>
                        <td>{{ $inventaire->code }}</td>
                        <td>{{ $inventaire->created_at }}</td>
                        <td>{{ $inventaire->nature }}</td>
                        <td><a href="{{ route('inventaire.show', $inventaire->id) }}">Voir</a></td>
                        <td><a href="{{ route('inventaire.edit', $inventaire->id) }}">Modifier</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- <h2 style="color: red;text-align : center;margin-top :10%">Page index en développement...</h2> --}}
    {{-- <h3 style="text-align: center">Faites l'inventaire <a href="{{ route('inventaire.create') }}">ici</a></h3> --}}
@endsection
