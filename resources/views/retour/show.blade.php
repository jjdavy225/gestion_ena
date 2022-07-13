@extends('template.primary')

@section('titre')
    {{ $retour->code }}
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    <div class="linksContainer">
        @can('responsable')
            @if ($retour->statut == 'R1S')
                <form action="{{ route('retour.validation') }}" method="post">
                    @csrf
                    <input type="hidden" name="mouvements[]" value="{{ $retour->id }}">
                    <button class="buttonLinksTab btn-success" id="submitVal" title="Valider"><i
                            class="fa-solid fa-check"></i></button>
                </form>
            @endif
        @endcan
        <form class="delete" action="{{ route('retour.destroy', $retour->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button class="buttonLinksTab btn-danger" title="Supprimer"><i class="fa-solid fa-trash-can"></i></button>
        </form>
    </div>
    <div class="tableShowContainer">
        <div>
            <h1>Infos</h1>
            <table class="table table-bordered">
                <tr>
                    <th>Numéro du retour</th>
                    <td>{{ $retour->code }}</td>
                </tr>
                <tr>
                    <th>Date du retour</th>
                    <td>{{ $retour->date }}</td>
                </tr>
                <tr>
                    <th>Bureau concerné</th>
                    <td>{{ $retour->bureau->site->designation }}-{{ $retour->bureau->designation }} <a
                            href="{{ route('patrimoine.show', $retour->bureau->id) }}"><i
                                class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i></a></td>
                </tr>
                <tr>
                    <th>Statut</th>
                    <td>
                        @if ($retour->statut == 'R1S')
                            Non validé
                        @elseif ($retour->statut == 'R1V')
                            Retour validé
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Agent</th>
                    <td>{{ $retour->agent->nom }} {{ $retour->agent->prenom }}</td>
                </tr>
            </table>
        </div>
    </div>
    <h4 class="text-center">Les articles retournés</h4>
    <table class="table table-bordered">
        <thead>
            <th>Désignation</th>
            <th>Marque</th>
            <th>Qte retournée</th>
        </thead>
        <tbody>
            @foreach ($retour->articles as $article)
                <tr>
                    <td>{{ $article->designation }}</td>
                    <td>{{ $article->marque->designation }}</td>
                    <td>{{ $article->pivot->quantite }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
