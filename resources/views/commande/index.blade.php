@extends('template.primary')

@section('titre')
    Liste des commandes
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
    <h1>Liste des commandes</h1>
    <div class="container">
        <table class="table table-success table-stripped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Objet</th>
                    <th>Statut de livraison</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($commandes as $commande)
                    <tr>
                        <td>{{ $commande->id }}</td>
                        <td>{{ $commande->num }}</td>
                        <td>{{ $commande->objet }}</td>
                        <td>{{ $commande->statut_liv }}</td>
                        <td><a href="{{ route('commande.show', $commande->id) }}">Voir</a></td>
                        <td><a href="{{ route('commande.edit', $commande->id) }}">Modifier</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <h4>Enregistrer une nouvelle commande <a href="{{ route('commande.create') }}">ici!</a></h4>
@endsection
