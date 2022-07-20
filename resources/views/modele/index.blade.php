@extends('template.primary')

@section('titre')
    Les modèles de véhicules
@endsection

@section('contenu')
    @canany(['agent', 'responsable'])
        <div class="linksContainer">
            <a class="buttonLinks" title="Nouveau modèle" href="{{ route('modele.create') }}"><i
                    class="fa-solid fa-plus"></i></a>
        </div>
    @endcanany
    <h1>Liste des modèles</h1>
    <table class="table datatable">
        <thead>
            <tr>
                <th>#</th>
                <th>Désignation</th>
                <th>Catégorie</th>
                <th>Type d'énergie</th>
                @canany(['agent', 'responsable'])
                    <th></th>
                @endcanany
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1
            @endphp
            @foreach ($modeles as $modele)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $modele->designation }}</td>
                    <td>{{ $modele->categorie }}</td>
                    <td>{{ $modele->type_energie }}</td>
                    @canany(['agent', 'responsable'])
                        <td class="tabButtonContainer">
                            <a class="buttonLinksTab btn-success" href="{{ route('modele.edit', $modele->id) }}"><i
                                    class="fa-solid fa-file-pen"></i></a>
                            <form class="delete" action="{{ route('modele.destroy', $modele->id) }}" method="post">
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
