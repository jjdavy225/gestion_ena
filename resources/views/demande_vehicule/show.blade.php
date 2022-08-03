@extends('template.primary')

@section('titre')
    Infos de la demande
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
                    <td>{{ $demandeVehicule->code }}</td>
                </tr>
                <tr>
                    <th>Objet</th>
                    <td>{{ $demandeVehicule->objet }}</td>
                </tr>
                <tr>
                    <th>Conducteur</th>
                    <td>{{ $demandeVehicule->conducteur->agent_conducteur->nom . ' ' . explode(' ', $demandeVehicule->conducteur->agent_conducteur->prenom)[0] }}
                        <a href="{{ route('conducteur.show', $demandeVehicule->conducteur_id) }}">
                            <i class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i></a>
                    </td>
                </tr>
                <tr>
                    <th>Date de sortie</th>
                    <td>{{ $demandeVehicule->date_sortie }}</td>
                </tr>
                <tr>
                    <th>Date de retour prévue</th>
                    <td>{{ $demandeVehicule->date_retour }}</td>
                </tr>
                <tr>
                    <th>Véhicule</th>
                    <td>
                        @if ($demandeVehicule->vehicule_id != null)
                            {{ $demandeVehicule->vehicule->immatriculation }}
                            <a href="{{ route('vehicule.show', $demandeVehicule->vehicule->id) }}">
                                <i class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i></a>
                        @else
                            Aucun véhicule attribué à cette demande
                        @endif
                    </td>
                </tr>
                {{-- @if ($demandeVehicule->vehicule_id != null)
                    <tr>
                        <th>Kilométrage éffectué</th>
                        <td></td>
                    </tr>
                @endif --}}
                <tr>
                    <th>Date de retour réelle</th>
                    <td>
                        @if ($demandeVehicule->date_retour_reelle != null)
                            {{ $demandeVehicule->date_retour_reelle }}
                        @else
                            Véhicule pas encore retourné
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Statut</th>
                    <td>
                        @if ($demandeVehicule->statut == 'D1S')
                            Demande non validée
                        @elseif($demandeVehicule->statut == 'D1V')
                            Demande validée
                        @else
                            Véhicule retournée
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Agent</th>
                    <td>{{ $demandeVehicule->agent->nom . ' ' . $demandeVehicule->agent->prenom }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
