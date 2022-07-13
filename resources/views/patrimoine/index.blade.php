@extends('template.primary')

@section('titre')
    Patrimoine de l'ENA
@endsection

@section('contenu')
    <h1>Liste des bureaux concernés</h1>
    <table class="table datatable">
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
                $i = 1;
            @endphp
            @foreach ($patrimoines->groupBy('bureau_id') as $id_bureau => $bureau)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $bureau->first()->bureau->site->designation }}-{{ $bureau->first()->bureau->designation }}
                    </td>
                    <td>{{ $bureau->count() }}</td>
                    <td class="tabButtonContainer">
                        <a class="buttonLinksTab btn-primary" href="{{ route('patrimoine.show', $id_bureau) }}"><i
                            class="fa-solid fa-folder-open"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
