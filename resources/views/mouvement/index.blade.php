@extends('template.primary')

@section('titre')
    Liste des mouvements
@endsection

@section('contenu')
    @if (Session::has('info'))
        <div class="alert alert-primary">
            {{ Session::get('info') }}
        </div>
    @endif
    @canany(['agent', 'responsable'])
        <a class="buttonLinks" href="{{ route('mouvement.create') }}">Nouveau mouvement</a>
    @endcanany
    <h1>Liste des mouvements</h1>
    <table class="table table-success table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Observation</th>
                <th>Date du mouvement</th>
                @canany(['agent', 'responsable'])
                    <th></th>
                @endcanany
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($mouvements as $mouvement)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $mouvement->code }}</td>
                    <td>{{ $mouvement->observation }}</td>
                    <td>{{ $mouvement->date }}</td>
                    @canany(['agent', 'responsable'])
                        <td class="tabButtonContainer">
                            <a href="{{ route('mouvement.show', $mouvement->id) }}">Voir</a>
                            <a href="{{ route('mouvement.edit', $mouvement->id) }}">Modifier</a>
                            <a href="{{ route('mouvement.destroy', $mouvement->id) }}">Supprimer</a>
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
