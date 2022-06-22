@extends('template.primary')

@section('titre')
    Fournisseurs
@endsection

@section('contenu')
<div class="linksContainer">
    @canany(['agent', 'responsable'])
        <a class="buttonLinks" href="{{ route('fournisseur.create') }}">Nouveau fournisseur</a>
    @endcanany
</div>
    <h1>Liste des fournisseurs</h1>
    <table class="table table-success table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Sigle</th>
                <th>Siège</th>
                @canany(['agent', 'responsable'])
                    <th></th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach ($fournisseurs as $fournisseur)
                <tr>
                    <td>{{ $fournisseur->id }}</td>
                    <td>{{ $fournisseur->code }}</td>
                    <td>{{ $fournisseur->sigle }}</td>
                    <td>{{ $fournisseur->siege }}</td>
                    @canany(['agent', 'responsable'])
                        <td class="tabButtonContainer">
                            <a class="buttonLinksTab" href="{{ route('fournisseur.show', $fournisseur->id) }}">Voir</a>
                            <a class="buttonLinksTab" href="{{ route('fournisseur.edit', $fournisseur->id) }}">Modifier</a>
                            <a class="buttonLinksTab" href="{{ route('fournisseur.destroy', $fournisseur->id) }}">Supprimer</a>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
