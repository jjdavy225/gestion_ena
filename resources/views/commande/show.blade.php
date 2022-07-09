@extends('template.primary')

@section('titre')
    {{ $commande->num }}
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
                    <th>Numéro de la commande</th>
                    <td>{{ $commande->num }}</td>
                </tr>
                <tr>
                    <th>Date de commande</th>
                    <td>{{ $commande->date }}</td>
                </tr>
                <tr>
                    <th>Objet</th>
                    <td>{{ $commande->objet }}</td>
                </tr>
                <tr>
                    <th>Fournisseur</th>
                    <td>{{ $commande->fournisseur->sigle }}</td>
                </tr>
                <tr>
                    <th>Téléphone du fournisseur</th>
                    <td>{{ $commande->fournisseur->tel }}</td>
                </tr>
                <tr>
                    <th>Agent</th>
                    <td>{{ $commande->agent->nom }} {{ $commande->agent->prenom }}</td>
                </tr>
                <tr>
                    <th>Statut</th>
                    <td>
                        @if ($commande->statut_liv == 'C1S')
                            Non validée
                        @elseif ($commande->statut_liv == 'C1V')
                            En attente de livraison
                        @elseif ($commande->statut_liv == 'C1P')
                            Partiel
                        @elseif ($commande->statut_liv == 'C1T')
                            Totalement livré
                        @endif
                    </td>
                </tr>
            </table>
        </div>
        @if ($commande->livraisons()->count() != 0)
            <div>
                <h1>Les livraisons concernées</h1>
                <table class="table table-bordered">
                    <thead>
                        <th>Code de la livraison</th>
                        <th>Stock de destination</th>
                    </thead>
                    <tbody>
                        @foreach ($commande->livraisons as $livraison)
                            <tr>
                                <td>{{ $livraison->code }} <a href="{{ route('livraison.show', $livraison->id) }}"><i
                                    class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i></a></td>
                                <td>{{ $livraison->stock->code }} <a href="{{ route('stock.show', $livraison->stock->id) }}"><i
                                    class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    <h4 class="text-center">Les articles commandés</h4>
    <table class="table table-bordered">
        <thead>
            <th>Désignation</th>
            <th>Marque</th>
            <th>Prix unitaire</th>
            <th>Qte commandée</th>
            <th>Qte livrée</th>
            <th>Qte restante</th>
        </thead>
        <tbody>
            @foreach ($commande->articles as $article)
                <tr>
                    <td>{{ $article->designation }}</td>
                    <td>{{ $article->marque->designation }}</td>
                    <td>{{ $article->pivot->prix_unitaire }}</td>
                    <td>{{ $article->pivot->quantite }}</td>
                    <td>{{ $article->pivot->quantite_livree }}</td>
                    <td>{{ $article->pivot->reste }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
