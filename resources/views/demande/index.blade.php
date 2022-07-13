@extends('template.primary')

@section('titre')
    Liste des demandes
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    @canany(['agent', 'responsable'])
        <div class="linksContainer">
            <a class="buttonLinks" href="{{ route('demande.create') }}"><i class="fa-solid fa-plus"></i></a>
        </div>
    @endcanany
    <h1>Liste des demandes</h1>
    <div class="container">

        <table class="table datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Objet</th>
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
                    $i = 1;
                @endphp
                @foreach ($demandes as $demande)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $demande->code }}</td>
                        <td>{{ $demande->objet }}</td>
                        <td>
                            @if ($demande->statut == 'D1S')
                                Demande non validée
                            @elseif ($demande->statut == 'D1V')
                                Non livrée
                            @elseif ($demande->statut == 'D1P')
                                Partielle
                            @elseif ($demande->statut == 'D1T')
                                Totale
                            @endif
                        </td>
                        @can('responsable')
                            @if ($demande->statut == 'D1S')
                                @php
                                    $check = true;
                                @endphp
                                <td><input type="checkbox" class="demande" value="{{ $demande->id }}">
                                </td>
                            @else
                                <td>Demande validée</td>
                            @endif
                        @endcan
                        @canany(['agent', 'responsable'])
                            <td class="tabButtonContainer">
                                <a class="buttonLinksTab btn-primary" href="{{ route('demande.show', $demande->id) }}"><i
                                        class="fa-solid fa-file-lines"></i></a>
                                <a class="buttonLinksTab btn-success" href="{{ route('demande.edit', $demande->id) }}"><i
                                        class="fa-solid fa-file-pen"></i></a>
                                <form class="delete" action="{{ route('demande.destroy', $demande->id) }}" method="post">
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
                <form action="{{ route('demande.validation') }}" method="post">
                    @csrf
                    <div class="container text-center">
                        <input type="hidden" name="demandes[]" id="dem">
                        <input class="btn btn-danger" id="submitVal" value="Valider">
                    </div>
                </form>
                <script>
                    document.getElementById('submitVal').addEventListener('click', (function() {
                        const demandes = document.getElementsByClassName('demande');
                        let dem = [];
                        for (let i = 0; i < demandes.length; i++) {
                            if (demandes[i].checked) {
                                dem.push(demandes[i].value);
                            }
                        }
                        document.getElementById('dem').value = dem;
                    }))
                </script>
            @endif
        @endcan
    </div>
@endsection
