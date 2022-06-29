@extends('template.primary')

@section('titre')
    Liste des livraisons
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    @if (Session::has('info'))
        <div class="alert alert-primary">
            {{ Session::get('info') }}
        </div>
    @endif
    @canany(['agent', 'responsable'])
        <a class="buttonLinks" href="{{ route('livraison.create') }}"><i class="fa-solid fa-plus"></i></a>
    @endcanany
    <h1>Liste des livraisons</h1>
    <div class="container">
        <table class="table table-success table-stripped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Date de livraison</th>
                    <th>Commande concernée</th>
                    <th>Statut</th>
                    @can('responsable')
                        <th>Choix pour validation</th>
                    @endcan
                    @canany(['agent', 'responsable'])
                        <th></th>
                    @endcanany
                </tr>
            </thead>
            <tbody>
                @php
                    $check = false;
                @endphp
                @foreach ($livraisons as $livraison)
                    <tr>
                        <td>{{ $livraison->id }}</td>
                        <td>{{ $livraison->code }}</td>
                        <td>{{ $livraison->date }}</td>
                        <td>
                            <a
                                href="{{ route('commande.show', $livraison->commande->id) }}">{{ $livraison->commande->num }}</a>
                        </td>
                        <td>
                            @if ($livraison->statut == 'L1S')
                                Livraison non validée
                            @elseif ($livraison->statut == 'L1V')
                                Livraison éffectuée
                            @endif
                        </td>
                        @can('responsable')
                            @if ($livraison->statut == 'L1S')
                                @php
                                    $check = true;
                                @endphp
                                <td><input class="livraison" type="checkbox" value="{{ $livraison->id }}"></td>
                            @else
                                <td>Livraison validée</td>
                            @endif
                        @endcan
                        @canany(['agent', 'responsable'])
                            <td class="tabButtonContainer">
                                <a class="buttonLinksTab" href="{{ route('livraison.show', $livraison->id) }}"><i
                                        class="fa-solid fa-file-lines"></i></a>
                                <a class="buttonLinksTab" href="{{ route('livraison.edit', $livraison->id) }}"><i
                                        class="fa-solid fa-file-pen"></i></a>
                                <form class="delete" onsubmit="return confirm('Do you really want to submit the form ?');"
                                    action="{{ route('livraison.destroy', $livraison->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="buttonLinksTab"><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </td>
                        @endcanany
                    </tr>
                @endforeach
            </tbody>
        </table>
        @can('responsable')
            @if ($check)
                <form action="{{ route('livraison.validation') }}" method="post">
                    @csrf
                    <div class="container text-center">
                        <input type="hidden" name="livraisons[]" id="liv">
                        <input class="btn btn-dark" id="submit" type="submit" value="Valider">
                    </div>
                </form>
                <script>
                    document.getElementById('submit').addEventListener('click', (function() {
                        const livraisons = document.getElementsByClassName('livraison');
                        let liv = [];
                        for (let i = 0; i < livraisons.length; i++) {
                            if (livraisons[i].checked) {
                                liv.push(livraisons[i].value);
                            }
                        }
                        document.getElementById('liv').value = liv;
                    }))
                </script>
            @endif
        @endcan
    </div>
@endsection
