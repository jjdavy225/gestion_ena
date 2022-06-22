@extends('template.primary')

@section('titre')
    Liste des bureaux
@endsection

@section('contenu')
    @if (Session::has('info'))
        <div class="alert alert-primary">
            {{ Session::get('info') }}
        </div>
    @endif
    <div class="linksContainer">
        @canany(['agent', 'responsable'])
            <a class="buttonLinks" href="{{ route('bureau.create') }}">Nouveau bureau</a>
        @endcanany
    </div>
    <h1>Liste des bureaux</h1>
    <table class="table table-success table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Désignation</th>
                <th>Site</th>
                @canany(['agent', 'responsable'])
                    <th></th>
                @endcanany
            </tr>
        </thead>
        <tbody>
            @foreach ($bureaux as $bureau)
                <tr>
                    <td>{{ $bureau->id }}</td>
                    <td>{{ $bureau->code }}</td>
                    <td>{{ $bureau->designation }}</td>
                    <td>{{ $bureau->site->designation }}</td>
                    @canany(['agent', 'responsable'])
                    <td class="tabButtonContainer">
                        <a href="{{ route('bureau.edit', $bureau->id) }}">Modifier</a>
                        <a href="{{ route('bureau.destroy', $bureau->id) }}">Supprimer</a>
                    </td>
                @endcanany
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
