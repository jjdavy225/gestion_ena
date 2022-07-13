@extends('template.primary')

@section('titre')
    Liste des livraisons
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    @canany(['agent', 'responsable'])
        <div class="linksContainer">
            <a class="buttonLinks" href="{{ route('livraison.create') }}"><i class="fa-solid fa-plus"></i></a>
        </div>
    @endcanany
    <h1>Liste des livraisons</h1>
    <div class="container">
        <table class="table datatable">
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
                    $i = 1
                @endphp
                @foreach ($livraisons as $livraison)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $livraison->code }}</td>
                        <td>{{ $livraison->date }}</td>
                        <td>
                            {{ $livraison->commande->num }}
                            <a href="{{ route('commande.show', $livraison->commande->id) }}"><i
                                    class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i></a>
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
                                <a class="buttonLinksTab btn-primary" href="{{ route('livraison.show', $livraison->id) }}"><i
                                        class="fa-solid fa-file-lines"></i></a>
                                <a class="buttonLinksTab btn-success" href="{{ route('livraison.edit', $livraison->id) }}"><i
                                        class="fa-solid fa-file-pen"></i></a>
                                <form class="delete" action="{{ route('livraison.destroy', $livraison->id) }}"
                                    method="post">
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
        @can('responsable')
            @if ($check)
                <form action="{{ route('livraison.validation') }}" method="post">
                    @csrf
                    <div class="container text-center">
                        <input type="hidden" name="livraisons[]" id="liv">
                        <input class="btn btn-danger" id="submitVal" value="Valider">
                    </div>
                </form>
                <script>
                    document.getElementById('submitVal').addEventListener('click', (function() {
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
