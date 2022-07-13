@extends('template.primary')

@section('titre')
    {{ $mouvement->code }}
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    <div class="linksContainer">
        @can('responsable')
            @if ($mouvement->statut == 'M1S')
                <form action="{{ route('mouvement.validation') }}" method="post">
                    @csrf
                    <input type="hidden" name="mouvements[]" value="{{ $mouvement->id }}">
                    <button class="buttonLinksTab btn-success" id="submitVal" title="Valider"><i class="fa-solid fa-check"></i></button>
                </form>
            @endif
        @endcan
        <form class="delete" action="{{ route('mouvement.destroy', $mouvement->id) }}" method="post">
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
                    <th>Numéro du mouvement</th>
                    <td>{{ $mouvement->code }}</td>
                </tr>
                <tr>
                    <th>Date du mouvement</th>
                    <td>{{ $mouvement->date }}</td>
                </tr>
                <tr>
                    <th>Type du mouvement</th>
                    <td>{{ $mouvement->date }}</td>
                </tr>
                <tr>
                    <th>Observation</th>
                    <td>{{ $mouvement->observation }}</td>
                </tr>
                <tr>
                    <th>Bureau initial</th>
                    <td>{{ $mouvement->bureau_initial->site->designation }}-{{ $mouvement->bureau_initial->designation }}
                        <a href="{{ route('patrimoine.show', $mouvement->bureau_initial_id) }}">
                            <i class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i></a>
                    </td>
                </tr>
                <tr>
                    <th>Bureau final</th>
                    <td>{{ $mouvement->bureau_final->site->designation }}-{{ $mouvement->bureau_final->designation }}
                        <a href="{{ route('patrimoine.show', $mouvement->bureau_final_id) }}">
                            <i class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i></a>
                    </td>
                </tr>
                <tr>
                    <th>Statut</th>
                    <td>
                        @if ($mouvement->statut == 'M1S')
                            Non validé
                        @elseif ($mouvement->statut == 'M1V')
                            Mouvement validé
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Agent mouvement</th>
                    <td>{{ $mouvement->agent_mouvement }}</td>
                </tr>
                <tr>
                    <th>Agent</th>
                    <td>{{ $mouvement->agent->nom }} {{ $mouvement->agent->prenom }}</td>
                </tr>
            </table>
        </div>
    </div>
    <h4 class="text-center">Les articles déplacés</h4>
    <table class="table table-bordered">
        <thead>
            <th>Désignation</th>
            <th>Marque</th>
            <th>Qte déplacée</th>
        </thead>
        <tbody>
            @foreach ($mouvement->articles as $article)
                <tr>
                    <td>{{ $article->designation }}</td>
                    <td>{{ $article->marque->designation }}</td>
                    <td>{{ $article->pivot->quantite }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
