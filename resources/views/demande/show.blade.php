@extends('template.primary')

@section('titre')
    {{ $demande->code }}
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    <h1>Infos</h1>
    <ul class="show">
        <li>Numéro de la demande : {{ $demande->code }}</li>
        <li>Date de demande : {{ $demande->date }}</li>
        <li>Objet : {{ $demande->objet }}</li>
        <li>Fiche : {{ $demande->fiche }}</li>
        <li>Delai : {{ $demande->delai }}</li>
        <li>Statut de sortie : {{ $demande->statut }}</li>
        <li>Code secteur : {{ $demande->code_secteur }}</li>
        <li>Code propriétaire : {{ $demande->code_proprietaire }}</li>
        <li>Les articles demandés
            <ul>
                @foreach ($demande->articles as $article)
                    <li>{{ $article->designation }} | {{$article->marque->designation}}
                        <ul>
                            <li>Quantité demandée : {{ $article->pivot->quantite }}</li>
                            <li>Quantité sortie : {{ $article->pivot->quantite_sortie }}</li>
                            <li>Reste : {{ $article->pivot->reste }}</li>
                        </ul>
                    </li>
                @endforeach
            </ul>
        </li>
        <li>Agent : {{ $demande->agent->nom }} {{ $demande->agent->prenom }}</li>
    </ul>
    <button><a href="{{ route('demande.index') }}">Retour</a></button>
@endsection
