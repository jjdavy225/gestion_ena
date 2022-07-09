@extends('template.primary')

@section('titre')
    {{ $demande->code }}
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
                    <th>Code de la demande</th>
                    <td>{{ $demande->code }}</td>
                </tr>
                <tr>
                    <th>Date de demande</th>
                    <td>{{ $demande->date }}</td>
                </tr>
                <tr>
                    <th>Objet</th>
                    <td>{{ $demande->objet }}</td>
                </tr>
                <tr>
                    <th>Fiche</th>
                    <td>{{ $demande->fiche }}</td>
                </tr>
                <tr>
                    <th>Delai</th>
                    <td>{{ $demande->delai }}</td>
                </tr>
                <tr>
                    <th>Agent</th>
                    <td>{{ $demande->agent->nom }} {{ $demande->agent->prenom }}</td>
                </tr>
                <tr>
                    <th>Code secteur</th>
                    <td>{{ $demande->code_secteur }}</td>
                </tr>
                <tr>
                    <th>Code propriétaire</th>
                    <td>{{ $demande->code_proprietaire }}</td>
                </tr>
                <tr>
                    <th>Statut</th>
                    <td>
                        @if ($demande->statut == 'D1S')
                            Non validée
                        @elseif ($demande->statut == 'D1V')
                            En attente de sortie
                        @elseif ($demande->statut == 'D1P')
                            Partiel
                        @elseif ($demande->statut == 'D1T')
                            Complètement sortie
                        @endif
                    </td>
                </tr>
            </table>
        </div>
        @if ($demande->sorties()->count() != 0)
            <div>
                <h1>Les sorties concernées</h1>
                <table class="table table-bordered">
                    <thead>
                        <th>Code de la sortie</th>
                        <th>Bureau de destination</th>
                    </thead>
                    <tbody>
                        @foreach ($demande->sorties as $sortie)
                            <tr>
                                <td>{{ $sortie->code }} <a href="{{ route('sortie.show', $sortie->id) }}"><i
                                            class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i></a></td>
                                <td>{{ $sortie->bureau->designation }}-{{ $sortie->bureau->site->designation }} <a
                                        href="{{ route('patrimoine.show', $sortie->bureau->id) }}"><i
                                            class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    <h4 class="text-center">Les articles demandés</h4>
    <table class="table table-bordered">
        <thead>
            <th>Désignation</th>
            <th>Marque</th>
            <th>Qte demandée</th>
            <th>Qte sortie</th>
            <th>Qte restante</th>
        </thead>
        <tbody>
            @foreach ($demande->articles as $article)
                <tr>
                    <td>{{ $article->designation }}</td>
                    <td>{{ $article->marque->designation }}</td>
                    <td>{{ $article->pivot->quantite }}</td>
                    <td>{{ $article->pivot->quantite_sortie }}</td>
                    <td>{{ $article->pivot->reste }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
