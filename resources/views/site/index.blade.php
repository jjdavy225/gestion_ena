@extends('template.primary')

@section('titre')
    Liste des sites
@endsection

@section('contenu')
    <div class="linksContainer">
        @canany(['agent', 'responsable'])
            <a class="buttonLinks" href="{{ route('site.create') }}"><i class="fa-solid fa-plus"></i></a>
        @endcanany
    </div>
    <h1>Liste des sites</h1>
    <table class="table datatable">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Désignation</th>
                {{-- <th></th> --}}
                @canany(['agent', 'responsable'])
                    <th></th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach ($sites as $site)
                <tr>
                    <td>{{ $site->id }}</td>
                    <td>{{ $site->code }}</td>
                    <td>{{ $site->designation }}</td>
                    @canany(['agent', 'responsable'])
                        <td class="tabButtonContainer">
                            <a class="buttonLinksTab btn-success" href="{{ route('site.edit', $site->id) }}"><i
                                    class="fa-solid fa-file-lines"></i></a>
                            <form class="delete" action="{{ route('site.destroy', $site->id) }}" method="post">
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
