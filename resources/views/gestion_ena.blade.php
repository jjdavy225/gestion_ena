@extends('template.primary')

@section('titre')
    Gestion ENA
@endsection

@section('contenu')
    <h1>Inventaire courant</h1>
    <table class="table table-success table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Quantité</th>
                <th>Mouvement</th>
                <th>Désignation</th>
                <th>Marque</th>
                <th>Type</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach (App\Models\Stock::all() as $stock)
                @foreach ($stock->articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>{{ $article->code }}</td>
                        <td>{{ $article->pivot->quantite_article }}</td>
                        <td>{{ $article->pivot->mouvement }}</td>
                        <td>{{ $article->designation }}</td>
                        <td>{{ $article->marque->designation }}</td>
                        <td>{{ $article->type->designation }}</td>
                        <td><a href="{{ route('stock.show', $stock->id) }}">{{ $stock->nature }}</a></td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
    <h2>Les commandes en attente de livraison</h2>
    @if (App\Models\Commande::where('statut_liv', '!=', 'Livrée')->count() == 0)
        <h5 style="color: red">Aucune commande en attente de livraison</h5>
    @else
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
                @foreach (App\Models\Commande::where('statut_liv', '!=', 'Livrée')->get() as $commande)
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
    @endif
@endsection
