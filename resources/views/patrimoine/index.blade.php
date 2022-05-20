@extends('template.primary')

@section('titre')
    Patrimoine de l'ENA
@endsection

@section('contenu')
    @if (Session::has('info'))
        <div class="alert alert-primary">
            {{ Session::get('info') }}
        </div>
    @endif
    <h1>Liste des bureaux concernés</h1>
    <table class="table table-success table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom du bureau</th>
                <th>Nombre d'articles différents</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @php
                $i=1
            @endphp 
            @foreach ($patrimoines->groupBy('bureau_id') as $id_bureau => $bureau)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$bureau->first()->bureau->site->designation}}-{{$bureau->first()->bureau->designation}}</td>
                    <td>{{$bureau->count()}}</td>
                    <td><a href="{{ route('patrimoine.show', $id_bureau) }}">Consulter</a></td>
                </tr>
                @php
                    $i++
                @endphp
            @endforeach
        </tbody>
    </table>
@endsection
