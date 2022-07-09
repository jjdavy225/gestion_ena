@extends('template.primary')

@section('titre')
    Inventaire
@endsection

@section('contenu')
    <h1>Liste des inventaires</h1>
    <div class="container">
        <table class="table datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Jour et heure</th>
                    <th>Nature</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1
                @endphp
                @foreach ($inventaires as $inventaire)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $inventaire->code }}</td>
                        <td>{{ $inventaire->created_at }}</td>
                        <td>{{ $inventaire->nature }}</td>
                        <td class="tabButtonContainer"><a class="buttonLinksTab btn-primary" href="{{ route('inventaire.show', $inventaire->id) }}"><i class="fa-solid fa-file-lines"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
