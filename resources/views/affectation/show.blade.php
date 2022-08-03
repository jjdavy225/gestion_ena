@extends('template.primary')

@section('titre')
    Infos affectation
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
                    <th>Code</th>
                    <td>{{ $affectation->code }}</td>
                </tr>
                <tr>
                    <th>Véhicule</th>
                    <td>{{ $affectation->vehicule->immatriculation }}
                        <a href="{{ route('vehicule.show', $affectation->vehicule->id) }}">
                            <i class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <th>Conducteur principal</th>
                    <td>{{ $affectation->conducteur_principal->agent_conducteur->nom . ' ' . $affectation->conducteur_principal->agent_conducteur->prenom }}
                        <a href="{{ route('conducteur.show', $affectation->conducteur_principal->id) }}">
                            <i class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <th>Conducteur secondaire</th>
                    <td>{{ $affectation->conducteur_secondaire->agent_conducteur->nom . ' ' . $affectation->conducteur_secondaire->agent_conducteur->prenom }}
                        <a href="{{ route('conducteur.show', $affectation->conducteur_secondaire->id) }}">
                            <i class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <th>Date de début</th>
                    <td>{{ $affectation->date_debut }}</td>
                </tr>
                <tr>
                    <th>Date de fin</th>
                    <td>{{ $affectation->date_fin_prevue }}</td>
                </tr>
                <tr>
                    <th>Direction</th>
                    <td>{{ $affectation->direction }}</td>
                </tr>
                <tr>
                    <th>Service</th>
                    <td>{{ $affectation->service }}</td>
                </tr>
                <tr>
                    <th>Statut</th>
                    <td>
                        @if ($affectation->statut == 'A1S')
                            Affectation non validée
                        @else
                            Affectation validée
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Agent</th>
                    <td>{{ $affectation->agent->nom . ' ' . $affectation->agent->prenom }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
