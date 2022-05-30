@extends('template.primary')

@section('titre')
    {{ $retour->code }}
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    <h1>Infos</h1>
    <ul class="show">
        <li>Numéro du retour : {{ $retour->code }}</li>
        <li>Date du retour : {{ $retour->date }}</li>
        <li>Bureau concerné : <a href="{{route('patrimoine.show',$retour->bureau->id)}}">{{ $retour->bureau->site->designation }}-{{$retour->bureau->designation}}</a></li>
        <li>Les articles retournés
            <ul>
                @foreach ($retour->articles as $article)
                    <li>{{ $article->designation }} | {{$article->marque->designation}}
                        <ul>
                            <li>Quantité retournée : {{ $article->pivot->quantite }}</li>
                        </ul>
                    </li>
                @endforeach
            </ul>
        </li>
        <li>Agent : {{ $retour->agent->nom }} {{ $retour->agent->prenom }}</li>
    </ul>
    <button><a href="{{ route('retour.index') }}">Retour</a></button>
@endsection