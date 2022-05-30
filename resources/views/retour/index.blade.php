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
    <h1>Liste des retours</h1>
    <table class="table table-success table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Observation</th>
                <th>Date de retour</th>
                <th></th>
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
                    <td><a href="{{ route('retour.show', $retour->id) }}">Voir</a></td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
        </tbody>
    </table>
    <h4>Enregistrer un nouveau retour <a href="{{ route('retour.create') }}">ici!</a></h4>
@endsection
