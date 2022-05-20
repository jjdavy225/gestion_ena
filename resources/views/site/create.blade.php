@extends('template.primary')

@section('titre')
    Nouveau site
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    <div class="container">
        <form action="{{ route('site.store') }}" method="post">
            @csrf
            <div class="container mt-3">
                <h3 class="text-center">Renseignez le nouveau site</h3>
            </div>
            <div class="row border rounded-5 p-4 mb-4 mt-4 shadow" id="conteneur_form_article">
                <div class="form-group mb-3">
                    <label class="form-label" for="designation">Désignation</label>
                    <input class="form-control" type="text" name="designation" id="designation"
                        value="{{ old('designation') }}">
                    @error('designation')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="boutons">
                    <input id="new_article_valider" type="submit" value="Valider">
                </div>

            </div>
        </form>
    </div>
@endsection
