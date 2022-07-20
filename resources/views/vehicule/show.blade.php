@extends('template.primary')

@section('titre')
    Infos véhicule
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
                    <th>Immatriculation du vehicule</th>
                    <td>{{ $vehicule->immatriculation }}</td>
                </tr>
                <tr>
                    <th>N° carte grise</th>
                    <td>{{ $vehicule->carte_grise }}</td>
                </tr>
                <tr>
                    <th>N° du châssis</th>
                    <td>{{ $vehicule->num_chassis }}</td>
                </tr>
                <tr>
                    <th>Date de mise en circulation</th>
                    <td>{{ $vehicule->date_mise_en_circulation }}</td>
                </tr>
                <tr>
                    <th>Type d'acquisition</th>
                    <td>{{ $vehicule->type_acquisition }}</td>
                </tr>
                <tr>
                    <th>Date d'acquisition</th>
                    <td>{{ $vehicule->date_acquisition }}</td>
                </tr>
                <tr>
                    <th>Kilométrage au compteur</th>
                    <td>{{ $vehicule->kilometrage }}</td>
                </tr>
                <tr>
                    <th>Fournisseur</th>
                    <td>{{ $vehicule->fournisseur->sigle }}<a
                        href="{{ route('fournisseur.show', $vehicule->fournisseur->id) }}"><i
                            class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i></a></td>
                </tr>
                <tr>
                    <th>Disponibilité</th>
                    <td>
                        @if ($vehicule->dispo)
                            <i class="fa-solid fa-check text-success"></i>
                        @else
                            <i class="fa-solid fa-xmark text-danger"></i>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Modèle</th>
                    <td>{{ $vehicule->modele->designation }}<a
                        href="{{ route('modele.index') }}"><i
                            class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i></a></td>
                </tr>
                <tr>
                    <th>Marque du véhicule</th>
                    <td>{{ $vehicule->marque_vehicule->designation }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
