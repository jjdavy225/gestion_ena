@extends('template.primary')

@section('titre')
    Liste des sorties
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    @if (Session::has('info'))
        <div class="alert alert-primary">
            {{ Session::get('info') }}
        </div>
    @elseif (Session::has('errors_qte'))
        <div class="alert alert-danger">
            {{ Session::get('errors_qte') }}
        </div>
    @endif
    @canany(['agent', 'responsable'])
        <a class="buttonLinks" href="{{ route('sortie.create') }}"><i class="fa-solid fa-plus"></i></a>
    @endcanany
    <h1>Liste des sorties</h1>
    <div class="container">
        @can('responsable')
            <form action="{{ route('sortie.validation') }}" method="post">
                @csrf
            @endcan
            <table class="table table-success table-stripped">
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
                    @endphp
                    @foreach ($sorties as $sortie)
                        <tr>
                            <td>{{ $sortie->id }}</td>
                            <td>{{ $sortie->code }}</td>
                            <td>{{ $sortie->date }}</td>
                            <td><a
                                    href="{{ route('demande.show', $sortie->demande->id) }}">{{ $sortie->demande->code }}</a>
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
                                    <td><input type="checkbox" name="sorties[]" value="{{ $sortie->id }}"
                                            id="articles">
                                    </td>
                                @else
                                    <td>Livraison validée</td>
                                @endif
                            @endcan
                            @canany(['agent', 'responsable'])
                                <td class="tabButtonContainer">
                                    <a href="{{ route('sortie.show', $sortie->id) }}"><i class="fa-solid fa-file-lines"></i></a>
                                    <a href="{{ route('sortie.edit', $sortie->id) }}"><i class="fa-solid fa-file-pen"></i></a>
                                    <a href="{{ route('sortie.destroy', $sortie->id) }}"><i class="fa-solid fa-trash-can"></i></a>
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
