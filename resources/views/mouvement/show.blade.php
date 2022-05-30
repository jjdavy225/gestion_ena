@extends('template.primary')

@section('titre')
    {{ $mouvement->code }}
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    <h1>Infos</h1>
    <ul class="show">
        <li>Numéro du mouvement : {{ $mouvement->code }}</li>
        <li>Date du mouvement : {{ $mouvement->date }}</li>
        <li>Type de mouvement : {{ $mouvement->type }}</li>
        <li>Observation : {{ $mouvement->observation }}</li>
        <li>Bureau initial : <a href="{{route('patrimoine.show',$mouvement->bureau_initial->id)}}">{{ $mouvement->bureau_initial->site->designation }}-{{$mouvement->bureau_initial->designation}}</a></li>
        <li>Bureau final : <a href="{{route('patrimoine.show',$mouvement->bureau_final->id)}}">{{ $mouvement->bureau_final->site->designation }}-{{$mouvement->bureau_final->designation}}</a></li>
        <li>Les articles concernés
            <ul>
                @foreach ($mouvement->articles as $article)
                    <li>{{ $article->designation }} | {{$article->marque->designation}}
                        <ul>
                            <li>Quantité déplacée : {{ $article->pivot->quantite }}</li>
                        </ul>
                    </li>
                @endforeach
            </ul>
        </li>
        <li>Agent de mouvement : {{ $mouvement->agent_mouvement }}</li>
        <li>Agent : {{ $mouvement->agent->nom }} {{ $mouvement->agent->prenom }}</li>
    </ul>
    <button><a href="{{ route('mouvement.index') }}">Retour</a></button>
@endsection