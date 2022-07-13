@extends('template.primary')

@section('titre')
    Liste des articles
@endsection

@section('contenu')
    @canany(['agent', 'responsable'])
        <div class="linksContainer">
            <a class="buttonLinks" title="Nouvel article" href="{{ route('article.create') }}"><i
                    class="fa-solid fa-plus"></i></a>
        </div>
    @endcanany
    <h1>Liste des articles</h1>
    <table class="table datatable">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Désignation</th>
                <th>Marque</th>
                <th>Type</th>
                {{-- <th></th> --}}
                @canany(['agent', 'responsable'])
                    <th></th>
                @endcanany
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->code }}</td>
                    <td>{{ $article->designation }}</td>
                    <td>{{ $article->marque->designation }}</td>
                    <td>{{ $article->type->designation }}</td>
                    @canany(['agent', 'responsable'])
                        <td class="tabButtonContainer">
                            <a class="buttonLinksTab btn-success" href="{{ route('article.edit', $article->id) }}"><i
                                    class="fa-solid fa-file-pen"></i></a>
                            <form class="delete" onsubmit="return confirm('Do you really want to submit the form ?');"
                                action="{{ route('article.destroy', $article->id) }}" method="post">
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
