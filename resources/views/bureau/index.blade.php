@extends('template.primary')

@section('titre')
    Liste des bureaux
@endsection

@section('contenu')
    <div class="linksContainer">
        @canany(['agent', 'responsable'])
            <a class="buttonLinks" href="{{ route('bureau.create') }}"><i class="fa-solid fa-plus"></i></a>
        @endcanany
    </div>
    <h1>Liste des bureaux</h1>
    <table class="table datatable">
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
                            <a class="buttonLinksTab btn-primary" href="{{ route('patrimoine.show', $bureau->id) }}"><i
                                    class="fa-solid fa-file-lines"></i></a>
                            <a class="buttonLinksTab btn-success" href="{{ route('bureau.edit', $bureau->id) }}"><i
                                    class="fa-solid fa-file-pen"></i></a>
                        </td>
                    @endcanany
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
