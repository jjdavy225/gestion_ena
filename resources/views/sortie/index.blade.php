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
    @canany(['agent', 'responsable'])
        <a class="buttonLinks" href="{{ route('sortie.create') }}">Nouvelle sortie</a>
    @endcanany
    <h1>Liste des sorties</h1>
    <div class="container">
        <table class="table table-success table-stripped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Date de la sortie</th>
                    <th>Demande concernée</th>
                    @canany(['agent', 'responsable'])
                        <th></th>
                    @endcanany
                </tr>
            </thead>
            <tbody>
                @foreach ($sorties as $sortie)
                    <tr>
                        <td>{{ $sortie->id }}</td>
                        <td>{{ $sortie->code }}</td>
                        <td>{{ $sortie->date }}</td>
                        <td><a href="{{ route('demande.show', $sortie->demande->id) }}">{{ $sortie->demande->code }}</a>
                        </td>
                        @canany(['agent', 'responsable'])
                            <td class="tabButtonContainer">
                                <a href="{{ route('sortie.show', $sortie->id) }}">Voir</a>
                                <a href="{{ route('sortie.edit', $sortie->id) }}">Modifier</a>
                                <a href="{{ route('sortie.destroy', $sortie->id) }}">Supprimer</a>
                            </td>
                        @endcanany
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
