@extends('template.primary')

@section('titre')
    Liste des demandes
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    @if (Session::has('info'))
        <div class="alert alert-primary">
            {{ Session::get('info') }}
        </div>
    @endif
    <h1>Liste des demandes</h1>
    <div class="container">
        <table class="table table-success table-stripped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Objet</th>
                    <th>Statut</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($demandes as $demande)
                    <tr>
                        <td>{{ $demande->id }}</td>
                        <td>{{ $demande->code }}</td>
                        <td>{{ $demande->objet }}</td>
                        <td>{{ $demande->statut }}</td>
                        <td><a href="{{ route('demande.show', $demande->id) }}">Voir</a></td>
                        <td><a href="{{ route('demande.edit', $demande->id) }}">Modifier</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <h4>Enregistrer une nouvelle demande <a href="{{ route('demande.create') }}">ici!</a></h4>
@endsection