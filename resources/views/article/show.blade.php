@extends('template.primary')

@section('contenu')
    <h1>Infos</h1>
    <ul>
        <li>Code de l'article : {{ $article->code }}</li>
        <li>Désignation : {{ $article->designation }}</li>
        <li>Marque : {{ $article->marque['designation'] }}</li>
        <li>Type : {{ $article->type['designation'] }}</li>
    </ul>
    <button><a href="{{ route('article.index') }}">Retour</a></button>
@endsection
