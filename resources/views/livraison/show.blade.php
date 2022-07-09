@extends('template.primary')

@section('titre')
    {{ $livraison->code }}
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    <div class="tableShowContainer">
        <div>
            <h1>Infos</h1>
            <table class="table table-bordered">
                <tr>
                    <th>Code de la livraison</th>
                    <td>{{ $livraison->code }}</td>
                </tr>
                <tr>
                    <th>Date de la livraison</th>
                    <td>{{ $livraison->date }}</td>
                </tr>
                <tr>
                    <th>Commande concernée</th>
                    <td>{{ $livraison->commande->num }} <a
                            href="{{ route('commande.show', $livraison->commande->id) }}"><i
                                class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i></a></td>
                </tr>
                <tr>
                    <th>Stock de destination</th>
                    <td>{{ $livraison->stock->code }} <a href="{{ route('stock.show', $livraison->stock->id) }}"><i
                                class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i></a></td>
                </tr>
                <tr>
                    <th>Fournisseur</th>
                    <td>{{ $livraison->commande->fournisseur->sigle }}</td>
                </tr>
                <tr>
                    <th>Agent</th>
                    <td>{{ $livraison->agent->nom }} {{ $livraison->agent->prenom }}</td>
                </tr>
                <tr>
                    <th>Statut</th>
                    <td>
                        @if ($livraison->statut == 'L1S')
                            Non validée
                        @elseif ($livraison->statut == 'L1V')
                            Livraison validée
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <h4 class="text-center">Les articles livrés</h4>
    <table class="table table-bordered">
        <thead>
            <th>Désignation</th>
            <th>Marque</th>
            <th>Qte livrée</th>
            <th>Qte restante</th>
            <th>Pprix unitaire</th>
        </thead>
        <tbody>
            @foreach ($livraison->articles as $article)
                <tr>
                    <td>{{ $article->designation }}</td>
                    <td>{{ $article->marque->designation }}</td>
                    <td>{{ $article->pivot->quantite_livree }}</td>
                    <td>{{ $article->pivot->reste }}</td>
                    <td>{{ $article->pivot->prix_unitaire }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
