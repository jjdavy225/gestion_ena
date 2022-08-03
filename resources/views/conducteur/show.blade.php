@extends('template.primary')

@section('titre')
    Infos conducteur
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
                    <th>Matricule</th>
                    <td>{{ $conducteur->agent_conducteur->matricule }}</td>
                </tr>
                <tr>
                    <th>Nom</th>
                    <td>{{ $conducteur->agent_conducteur->nom }}</td>
                </tr>
                <tr>
                    <th>Prénoms</th>
                    <td>{{ $conducteur->agent_conducteur->prenom }}</td>
                </tr>
                <tr>
                    <th>Type de permis</th>
                    <td>{{ $conducteur->type_permis }}</td>
                </tr>
                <tr>
                    <th>Numéro du permis</th>
                    <td>{{ $conducteur->numero_permis }}</td>
                </tr>
                <tr>
                    <th>Fin de validité du permis</th>
                    <td>{{ $conducteur->validite_permis }}</td>
                </tr>
                <tr>
                    <th>Agent</th>
                    <td>{{ $conducteur->agent->nom.' '.$conducteur->agent->prenom}}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
