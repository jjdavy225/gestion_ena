@extends('template.primary')

@section('titre')
    Infos panne
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
                    <th>Code de la panne</th>
                    <td>{{ $panne->code }}</td>
                </tr>
                <tr>
                    <th>Vehicule concerné</th>
                    <td>{{ $panne->vehicule->immatriculation }}
                        <a href="{{ route('vehicule.show', $panne->vehicule->id) }}">
                            <i class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i></a>
                    </td>
                </tr>
                <tr>
                    <th>Causes</th>
                    <td>{{ $panne->causes }}</td>
                </tr>
                <tr>
                    <th>Observation</th>
                    <td>{{ $panne->observation }}</td>
                </tr>
                <tr>
                    <th>Dégâts</th>
                    <td>{{ $panne->degats }}</td>
                </tr>
                <tr>
                    <th>Date de la panne</th>
                    <td>{{ $panne->date_panne }}</td>
                </tr>
                <tr>
                    <th>Véhicule utilisable</th>
                    <td>
                        @if ($panne->vehicule_utilisable)
                            <i class="fa-solid fa-check text-success"></i>
                        @else
                            <i class="fa-solid fa-xmark text-danger"></i>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Réparé</th>
                    <td>
                        @if ($panne->repare)
                            <i class="fa-solid fa-check text-success"></i>
                        @else
                            <i class="fa-solid fa-xmark text-danger"></i>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Statut</th>
                    <td>
                        @if ($panne->statut == 'P1S')
                            Panne non validée
                        @else
                            Panne validée
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Agent</th>
                    <td>{{ $panne->agent->nom.' '.$panne->agent->prenom}}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
