@extends('template.primary')

@section('titre')
    {{ $livraison->code }}
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ secure_asset('css/style1.css') }}">
@endsection

@section('contenu')
    <h1>Infos</h1>
    <ul class="show">
        <li>Numéro de la livraison : {{ $livraison->code }}</li>
        <li>Date de livraison : {{ $livraison->date }}</li>
        <li>Commande concernée : <a href="{{route('commande.show',$livraison->commande->id)}}">{{ $livraison->commande->num }}</a></li>
        <li>Fournisseur : {{ $livraison->commande->fournisseur->sigle }}</li>
        <li>Stock : <a href="{{route('stock.show',$livraison->stock->id)}}">{{ $livraison->stock->code }}</a> | {{$livraison->stock->nature}}</li>
        <li>Les articles livrés
            <ul>
                @foreach ($livraison->articles as $article)
                    <li>{{ $article->designation }} | {{$article->marque->designation}}
                        <ul>
                            <li>Quantité livrée : {{ $article->pivot->quantite_livree }}</li>
                            <li>Quantité restante : {{ $article->pivot->reste }}</li>
                            <li>Prix unitaire : {{ $article->pivot->prix_unitaire }}</li>
                        </ul>
                    </li>
                @endforeach
            </ul>
        </li>
        <li>Agent : {{ $livraison->agent->nom }} {{ $livraison->agent->prenom }}</li>
    </ul>
    <button><a href="{{ route('livraison.index') }}">Retour</a></button>
@endsection