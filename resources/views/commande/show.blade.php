@extends('template.primary')

@section('titre')
    {{ $commande->num }}
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ secure_asset('css/style1.css') }}">
@endsection

@section('contenu')
    <h1>Infos</h1>
    <ul class="show">
        <li>Numéro de la commande : {{ $commande->num }}</li>
        <li>Date de commande : {{ $commande->date }}</li>
        <li>Objet : {{ $commande->objet }}</li>
        <li>Fournisseur : {{ $commande->fournisseur->sigle }}</li>
        <li>Tel fournisseur : {{ $commande->fournisseur->tel }}</li>
        <li>Statut de livraison : {{ $commande->statut_liv }}
            @if ($commande->statut_liv != 'Non livrée')
                <span> | Nombre de livraisons éffectuées : {{ count($commande->livraisons) }}</span>
                <ul>Les livraisons concernées
                    @foreach ($commande->livraisons as $livraison)
                        <li><a href="{{route('livraison.show', $livraison->id)}}">{{$livraison->code}}</a></li>
                    @endforeach
                </ul>
            @endif
        </li>
        <li>Les articles commandés
            <ul>
                @foreach ($commande->articles as $article)
                    <li>{{ $article->designation }} | {{$article->marque->designation}}
                        <ul>
                            <li>Quantité commandée : {{ $article->pivot->quantite }}</li>
                            <li>Quantité livrée : {{ $article->pivot->quantite_livree }}</li>
                            <li>Quantité restante : {{ $article->pivot->reste }}</li>
                        </ul>
                    </li>
                @endforeach
            </ul>
        </li>
        <li>Agent : {{ $commande->agent->nom }} {{ $commande->agent->prenom }}</li>
    </ul>
    <button><a href="{{ route('commande.index') }}">Retour</a></button>
@endsection
