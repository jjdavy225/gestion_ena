@extends('template.primary')

@section('titre')
    Modification du modèle
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    <div class="container">
        <form action="{{ route('modele.update',$modele->id) }}" method="post">
            @csrf
            @method('put')
            <div class="container mt-3">
                <h3 class="text-center">Modifiez le modèle</h3>
            </div>
            <div class="row border rounded-5 p-4 mb-4 mt-4 shadow" id="conteneur_form_article">
                <div class="form-group mb-3">
                    <label class="form-label" for="designation">Désignation</label>
                    <input required class="form-control" type="text" name="designation" id="designation"
                        value="{{ old('designation', $modele->designation) }}">
                    @error('designation')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="categorie">Catégorie de véhicule</label>
                    <input required class="form-control" type="text" name="categorie" id="categorie"
                        value="{{ old('categorie', $modele->categorie) }}">
                    @error('categorie')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="type_energie">Type d'énergie</label>
                    <input required class="form-control" type="text" name="type_energie" id="type_energie"
                        value="{{ old('type_energie', $modele->type_energie) }}">
                    @error('type_energie')
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
