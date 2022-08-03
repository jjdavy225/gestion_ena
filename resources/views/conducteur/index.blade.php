@extends('template.primary')

@section('titre')
    Les conducteurs
@endsection

@section('contenu')
    @canany(['agent', 'responsable'])
        <div class="linksContainer">
            <a class="buttonLinks" title="Nouveau conducteur" href="{{ route('conducteur.create') }}">
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>
    @endcanany
    <h1>Liste des conducteurs</h1>
    <table class="table datatable">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Prenoms</th>
                <th>N° permis</th>
                @canany(['agent', 'responsable'])
                    <th></th>
                @endcanany
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($conducteurs as $conducteur)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $conducteur->agent_conducteur->nom }}</td>
                    <td>{{ $conducteur->agent_conducteur->prenom }}</td>
                    <td>{{ $conducteur->numero_permis }}</td>
                    @canany(['agent', 'responsable'])
                        <td class="tabButtonContainer">
                            <a class="buttonLinksTab btn-primary" href="{{ route('conducteur.show', $conducteur->id) }}"><i
                                    class="fa-solid fa-file-lines"></i></a>
                            <a class="buttonLinksTab btn-success" href="{{ route('conducteur.edit', $conducteur->id) }}"><i
                                    class="fa-solid fa-file-pen"></i></a>
                            <form class="delete" action="{{ route('conducteur.destroy', $conducteur->id) }}" method="post">
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
