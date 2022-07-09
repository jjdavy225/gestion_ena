@extends('template.primary')

@section('titre')
    Fournisseurs
@endsection

@section('contenu')
    @canany(['agent', 'responsable'])
        <div class="linksContainer">
            <a class="buttonLinks" href="{{ route('fournisseur.create') }}"><i class="fa-solid fa-plus"></i></a>
        </div>
    @endcanany

    <h1>Liste des fournisseurs</h1>
    <table class="table table-success table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Sigle</th>
                <th>Siège</th>
                @canany(['agent', 'responsable'])
                    <th></th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach ($fournisseurs as $fournisseur)
                <tr>
                    <td>{{ $fournisseur->id }}</td>
                    <td>{{ $fournisseur->code }}</td>
                    <td>{{ $fournisseur->sigle }}</td>
                    <td>{{ $fournisseur->siege }}</td>
                    @canany(['agent', 'responsable'])
                        <td class="tabButtonContainer">
                            <a class="buttonLinksTab btn-primary" href="{{ route('fournisseur.show', $fournisseur->id) }}"><i
                                    class="fa-solid fa-file-lines"></i></a>
                            <a class="buttonLinksTab btn-success" href="{{ route('fournisseur.edit', $fournisseur->id) }}"><i
                                    class="fa-solid fa-file-pen"></i></a>
                            <form class="delete" onsubmit="return confirm('Do you really want to submit the form ?');"
                                action="{{ route('fournisseur.destroy', $fournisseur->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="buttonLinksTab btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                            </form>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
