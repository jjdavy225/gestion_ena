@extends('template.primary')

@section('titre')
    Liste des sorties
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    @canany(['agent', 'responsable'])
        <div class="linksContainer">
            <a class="buttonLinks" href="{{ route('sortie.create') }}"><i class="fa-solid fa-plus"></i></a>
        </div>
    @endcanany
    <h1>Liste des sorties</h1>
    <div class="container">
        <table class="table datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Date de la sortie</th>
                    <th>Demande concernée</th>
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
                @foreach ($sorties as $sortie)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $sortie->code }}</td>
                        <td>{{ $sortie->date }}</td>
                        <td>{{ $sortie->demande->code }}
                            <a href="{{ route('demande.show', $sortie->demande->id) }}"><i
                                    class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i></a>
                        </td>
                        <td>
                            @if ($sortie->statut == 'S1S')
                                Sortie non validée
                            @elseif ($sortie->statut == 'S1V')
                                Sortie éffectuée
                            @endif
                        </td>
                        @can('responsable')
                            @if ($sortie->statut == 'S1S')
                                @php
                                    $check = true;
                                @endphp
                                <td><input type="checkbox" class="sortie" value="{{ $sortie->id }}" id="articles">
                                </td>
                            @else
                                <td>Livraison validée</td>
                            @endif
                        @endcan
                        @canany(['agent', 'responsable'])
                            <td class="tabButtonContainer">
                                <a class="buttonLinksTab btn-primary" href="{{ route('sortie.show', $sortie->id) }}"><i
                                        class="fa-solid fa-file-lines"></i></a>
                                <a class="buttonLinksTab btn-success" href="{{ route('sortie.edit', $sortie->id) }}"><i
                                        class="fa-solid fa-file-pen"></i></a>
                                <form class="delete" action="{{ route('sortie.destroy', $sortie->id) }}" method="post">
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
                <form action="{{ route('sortie.validation') }}" method="post">
                    @csrf
                    <div class="container text-center">
                        <input type="hidden" name="sorties[]" id="sor">
                        <input class="btn btn-danger" id="submitVal" value="Valider">
                    </div>
                </form>
                <script>
                    document.getElementById('submitVal').addEventListener('click', (function() {
                        const sorties = document.getElementsByClassName('sortie');
                        let sor = [];
                        for (let i = 0; i < sorties.length; i++) {
                            if (sorties[i].checked) {
                                sor.push(sorties[i].value);
                            }
                        }
                        document.getElementById('sor').value = sor;
                    }))
                </script>
            @endif
        @endcan
    </div>
@endsection
