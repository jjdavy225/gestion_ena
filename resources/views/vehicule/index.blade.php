@extends('template.primary')

@section('titre')
    Les véhicules
@endsection

@section('contenu')
    @canany(['agent', 'responsable'])
        <div class="linksContainer">
            <a class="buttonLinks" title="Nouveau véhicule" href="{{ route('vehicule.create') }}"><i
                    class="fa-solid fa-plus"></i></a>
        </div>
    @endcanany
    <h1>Liste des véhicules</h1>
    <table class="table datatable">
        <thead>
            <tr>
                <th>#</th>
                <th>Immatriculation</th>
                <th>Kilométrage</th>
                <th>Disponibilité</th>
                <th>Modèle</th>
                <th>Marque</th>
                @canany(['agent', 'responsable'])
                    <th></th>
                @endcanany
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($vehicules as $vehicule)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $vehicule->immatriculation }}</td>
                    <td>{{ $vehicule->kilometrage }}</td>
                    <td>
                        @if ($vehicule->dispo)
                            <i class="fa-solid fa-check text-success"></i>
                        @else
                            <i class="fa-solid fa-xmark text-danger"></i>
                        @endif
                    </td>
                    <td>{{ $vehicule->modele->designation }}</td>
                    <td>{{ $vehicule->marque_vehicule->designation }}</td>
                    @canany(['agent', 'responsable'])
                        <td class="tabButtonContainer">
                            <a class="buttonLinksTab btn-primary" href="{{ route('vehicule.show', $vehicule->id) }}"><i
                                    class="fa-solid fa-file-lines"></i></a>
                            <a class="buttonLinksTab btn-success" href="{{ route('vehicule.edit', $vehicule->id) }}"><i
                                    class="fa-solid fa-file-pen"></i></a>
                            <form class="delete" action="{{ route('vehicule.destroy', $vehicule->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="buttonLinksTab btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                            </form>
                        </td>
                    @endcanany
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
