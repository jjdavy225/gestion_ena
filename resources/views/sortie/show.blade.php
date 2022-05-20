@extends('template.primary')

@section('titre')
    {{ $sortie->code }}
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    <h1>Infos</h1>
    <ul class="show">
        <li>Numéro de la sortie : {{ $sortie->code }}</li>
        <li>Date de sortie : {{ $sortie->date }}</li>
        <li>Demande concernée : <a href="{{route('demande.show',$sortie->demande->id)}}">{{ $sortie->demande->code }}</a></li>
        <li>Bureau : {{$sortie->bureau->site->designation}}-{{$sortie->bureau->designation}}</li>
        <li>Les articles sortis
            <ul>
                @foreach ($sortie->articles as $article)
                    <li>{{ $article->designation }} | {{$article->marque->designation}}
                        <ul>
                            <li>Quantité sortie : {{ $article->pivot->quantite_sortie }}</li>
                            <li>Quantité restante : {{ $article->pivot->reste }}</li>
                        </ul>
                    </li>
                @endforeach
            </ul>
        </li>
        <li>Agent : {{ $sortie->agent->nom }} {{ $sortie->agent->prenom }}</li>
    </ul>
    <button><a href="{{ route('sortie.index') }}">Retour</a></button>
@endsection