@extends('template.primary')

@section('titre')
    Liste des livraisons
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
    <h1>Liste des livraisons</h1>
    <div class="container">
        <table class="table table-success table-stripped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Date de livraison</th>
                    <th>Commande concernée</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($livraisons as $livraison)
                    <tr>
                        <td>{{ $livraison->id }}</td>
                        <td>{{ $livraison->code }}</td>
                        <td>{{ $livraison->date }}</td>
                        <td><a href="{{ route('commande.show', $livraison->commande->id) }}">{{ $livraison->commande->num }}</a></td>
                        <td><a href="{{ route('livraison.show', $livraison->id) }}">Voir</a></td>
                        <td><a href="{{ route('livraison.edit', $livraison->id) }}">Modifier</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <h4>Enregistrer une nouvelle livraison <a href="{{ route('livraison.create') }}">ici!</a></h4>
@endsection
