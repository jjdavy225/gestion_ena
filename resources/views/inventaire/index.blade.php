@extends('template.primary')

@section('titre')
    Inventaire
@endsection

@section('contenu')
    @if (Session::has('info'))
        <div class="alert alert-primary">
            {{ Session::get('info') }}
        </div>
    @endif
    <h2 style="color: red;text-align : center;margin-top :10%">Page index en développement...</h2>
    <h3 style="text-align: center">Faites l'inventaire <a href="{{ route('inventaire.create') }}">ici</a></h3>
@endsection
