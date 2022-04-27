@extends('template.primary')

@section('titre')
    Liste des sorties
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
    <h1>Liste des sorties</h1>
    <div class="container">
        <table class="table table-success table-stripped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Date de la sortie</th>
                    <th>Demande concernée</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sorties as $sortie)
                    <tr>
                        <td>{{ $sortie->id }}</td>
                        <td>{{ $sortie->code }}</td>
                        <td>{{ $sortie->date }}</td>
                        <td><a
                                href="{{ route('demande.show', $sortie->demande->id) }}">{{ $sortie->demande->code }}</a>
                        </td>
                        <td><a href="{{ route('sortie.show', $sortie->id) }}">Voir</a></td>
                        <td><a href="{{ route('sortie.edit', $sortie->id) }}">Modifier</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <h4>Enregistrer une nouvelle sortie <a href="{{ route('sortie.create') }}">ici!</a></h4>
@endsection
