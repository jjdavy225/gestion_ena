@extends('template.primary')

@section('titre')
    {{ $sortie->code }}
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    <div class="tableShowContainer">
        <div>
            <h1>Infos</h1>
            <table class="table table-bordered">
                <tr>
                    <th>Numéro de la sortie</th>
                    <td>{{ $sortie->code }}</td>
                </tr>
                <tr>
                    <th>Date de la sortie</th>
                    <td>{{ $sortie->date }}</td>
                </tr>
                <tr>
                    <th>Demande concernée</th>
                    <td>{{ $sortie->demande->code }} <a
                            href="{{ route('demande.show', $sortie->demande->id) }}"><i
                                class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i></a></td>
                </tr>
                <tr>
                    <th>Bureau de destination</th>
                    <td>{{ $sortie->bureau->site->designation }}-{{ $sortie->bureau->designation }} <a href="{{ route('patrimoine.show', $sortie->bureau->id) }}"><i
                                class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i></a></td>
                </tr>
                <tr>
                    <th>Agent</th>
                    <td>{{ $sortie->agent->nom }} {{ $sortie->agent->prenom }}</td>
                </tr>
                <tr>
                    <th>Statut</th>
                    <td>
                        @if ($sortie->statut == 'S1S')
                            Non validée
                        @elseif ($sortie->statut == 'S1V')
                            Sortie validée
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <h4 class="text-center">Les articles sortis</h4>
    <table class="table table-bordered">
        <thead>
            <th>Désignation</th>
            <th>Marque</th>
            <th>Qte sortie</th>
            <th>Qte restante</th>
        </thead>
        <tbody>
            @foreach ($sortie->articles as $article)
                <tr>
                    <td>{{ $article->designation }}</td>
                    <td>{{ $article->marque->designation }}</td>
                    <td>{{ $article->pivot->quantite_sortie }}</td>
                    <td>{{ $article->pivot->reste }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
