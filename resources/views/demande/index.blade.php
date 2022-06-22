@extends('template.primary')

@section('titre')
    Liste des demandes
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
        <a class="buttonLinks" href="{{ route('demande.create') }}"><i class="fa-solid fa-plus"></i></a>
    @endcanany
    <h1>Liste des demandes</h1>
    <div class="container">
        @can('responsable')
            <form action="{{ route('demande.validation') }}" method="post">
                @csrf
            @endcan
            <table class="table table-success table-stripped">
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
                    @endphp
                    @foreach ($demandes as $demande)
                        <tr>
                            <td>{{ $demande->id }}</td>
                            <td>{{ $demande->code }}</td>
                            <td>{{ $demande->objet }}</td>
                            <td>
                                @if ($demande->statut == 'D1S')
                                    Commande non validée
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
                                    <td><input type="checkbox" name="demandes[]" value="{{ $demande->id }}" id="articles">
                                    </td>
                                @else
                                    <td>Demande validée</td>
                                @endif
                            @endcan
                            @canany(['agent', 'responsable'])
                                <td class="tabButtonContainer">
                                    <a href="{{ route('demande.show', $demande->id) }}"><i
                                            class="fa-solid fa-file-lines"></i></a>
                                    <a href="{{ route('demande.edit', $demande->id) }}"><i
                                            class="fa-solid fa-file-pen"></i></a>
                                    <a href="{{ route('demande.destroy', $demande->id) }}"><i
                                            class="fa-solid fa-trash-can"></i></a>
                                </td>
                            @endcanany
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @can('responsable')
                <div class="container text-center">
                    <input class="btn btn-dark" type="submit" value="Valider">
                </div>
            </form>
        @endcan
    </div>
@endsection
