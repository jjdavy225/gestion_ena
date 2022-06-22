@extends('template.primary')

@section('titre')
    Liste des retours
@endsection

@section('contenu')
    @if (Session::has('info'))
        <div class="alert alert-primary">
            {{ Session::get('info') }}
        </div>
    @endif
    <div class="linksContainer">
        @canany(['agent', 'responsable'])
            <a class="buttonLinks" href="{{ route('retour.create') }}">Nouveau retour</a>
        @endcanany
    </div>
    <h1>Liste des retours</h1>
    <table class="table table-success table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Observation</th>
                <th>Date de retour</th>
                @canany(['agent', 'responsable'])
                    <th></th>
                @endcanany
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($retours as $retour)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $retour->code }}</td>
                    <td>{{ $retour->observation }}</td>
                    <td>{{ $retour->date }}</td>
                    @canany(['agent', 'responsable'])
                        <td class="tabButtonContainer">
                            <a href="{{ route('retour.show', $retour->id) }}">Voir</a>
                            <a href="{{ route('retour.edit', $retour->id) }}">Modifier</a>
                            <a href="{{ route('retour.destroy', $retour->id) }}">Supprimer</a>
                        </td>
                    @endcanany
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
        </tbody>
    </table>
@endsection
