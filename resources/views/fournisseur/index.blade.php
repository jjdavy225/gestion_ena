@extends('template.primary')

@section('titre')
    Fournisseurs
@endsection

@section('contenu')
    <h1>Liste des fournisseurs</h1>
    <table class="table table-success table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Sigle</th>
                <th>Siège</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fournisseurs as $fournisseur)
                <tr>
                    <td>{{ $fournisseur->id }}</td>
                    <td>{{ $fournisseur->code }}</td>
                    <td>{{ $fournisseur->sigle }}</td>
                    <td>{{ $fournisseur->siege }}</td>
                    <td><a href="{{ route('fournisseur.show', $fournisseur->id) }}">Voir</a></td>
                    <td><a href="{{ route('fournisseur.edit', $fournisseur->id) }}">Modifier</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h4>Enregistrer un nouveau fournisseur <a href="{{ route('fournisseur.create') }}">ici!</a></h4>
@endsection
