@extends('template.primary')

@section('titre')
    Infos réparation
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
                    <th>Code de la réparation</th>
                    <td>{{ $reparation->code }}</td>
                </tr>
                <tr>
                    <th>Panne concernée</th>
                    <td>{{ $reparation->panne->code }}
                        <a href="{{ route('panne.show', $reparation->panne->id) }}">
                            <i class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i></a>
                    </td>
                </tr>
                <tr>
                    <th>Date de la réparation</th>
                    <td>{{ $reparation->date }}</td>
                </tr>
                <tr>
                    <th>Montant</th>
                    <td>{{ $reparation->montant }} Fcfa</td>
                </tr>
                <tr>
                    <th>Observation</th>
                    <td>{{ $reparation->observation }}</td>
                </tr>
                <tr>
                    <th>Agent de réparation</th>
                    <td>{{ $reparation->agent_reparation }}</td>
                </tr>
                <tr>
                    <th>Statut</th>
                    <td>
                        @if ($reparation->statut == 'P1S')
                            Panne non validée
                        @else
                            Panne validée
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Agent</th>
                    <td>{{ $reparation->agent->nom.' '.$reparation->agent->prenom}}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
