@extends('template.primary')

@section('titre')
    Liste des STOCKS
@endsection

@section('contenu')
    @canany(['agent', 'responsable'])
        <div class="linksContainer">
            <a class="buttonLinks" href="{{ route('stock.create') }}"><i class="fa-solid fa-plus"></i></a>
        </div>
    @endcanany
    <h1>La liste des stocks</h1>
    <table class="table datatable" id="example">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Nature</th>
                <th>Nb d'articles en stock</th>
                @canany(['agent', 'responsable'])
                    <th></th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1
            @endphp
            @foreach ($stocks as $stock)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $stock->code }}</td>
                    <td>{{ $stock->nature }}</td>
                    <td>{{ $stock->stock }}</td>
                    @canany(['agent', 'responsable'])
                        <td class="tabButtonContainer">
                            <a class="buttonLinksTab btn-primary" href="{{ route('stock.show', $stock->id) }}"><i
                                    class="fa-solid fa-folder-open"></i></a>
                            <a class="buttonLinksTab btn-success" href="{{ route('stock.edit', $stock->id) }}"><i
                                    class="fa-solid fa-file-pen"></i></a>
                            <form class="delete" action="{{ route('stock.destroy', $stock->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="buttonLinksTab btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                            </form>
                        </td>
                    @endcanany
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
