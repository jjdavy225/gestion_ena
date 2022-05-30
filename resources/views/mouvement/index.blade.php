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
    <h1>Liste des mouvements</h1>
    <table class="table table-success table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Observation</th>
                <th>Date du mouvement</th>
                <th></th>
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
                    <td><a href="{{ route('mouvement.show', $mouvement->id) }}">Voir</a></td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
        </tbody>
    </table>
    <h4>Enregistrer un nouveau mouvement <a href="{{ route('mouvement.create') }}">ici!</a></h4>
@endsection
