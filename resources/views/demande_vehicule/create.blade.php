@extends('template.primary')

@section('titre')
    Nouvelle demande de véhicule
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    <div class="container">
        <form action="{{ route('demande_vehicule.store') }}" method="post">
            @csrf
            <div class="container mt-3">
                <h3 class="text-center">Demande de véhicule</h3>
            </div>
            <div class="row border rounded-5 p-4 mb-4 mt-4 shadow" id="conteneur_form_article">

                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label class="form-label">Conducteur <span class="text-danger"> *</span></label>
                        <select required class="form-select @error('conducteur') is-invalid @enderror" name="conducteur">
                            <option value="">Choisissez le conducteur</option>
                            @foreach ($conducteurs as $conducteur)
                                <option @if($conducteur->id == old('conducteur')) {{ 'selected' }}@endif value="{{ $conducteur->id }}">{{ $conducteur->agent_conducteur->nom.' '.$conducteur->agent_conducteur->prenom }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            @error('conducteur')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="objet">Objet de sortie <span class="text-danger"> *</span></label>
                        <input required class="form-control @error('objet') is-invalid @enderror" type="text"
                            name="objet" id="objet" value="{{ old('objet') }}">
                        <div class="invalid-feedback">
                            @error('objet')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label class="form-label" for="date_sortie">Date de sortie <span class="text-danger"> *</span></label>
                        <input required class="form-control @error('date_sortie') is-invalid @enderror" type="date" name="date_sortie" id="date_sortie"
                            value="{{ old('date_sortie') }}">
                        <div class="invalid-feedback">
                            @error('date_sortie')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="date_retour">Date de retour prévue <span class="text-danger"> *</span></label>
                        <input required class="form-control @error('date_retour') is-invalid @enderror" type="date" name="date_retour" id="date_retour"
                            value="{{ old('date_retour') }}">
                        <div class="invalid-feedback">
                            @error('date_retour')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="text-secondary text-center small">
                    Les champs avec un (<span class="text-danger">*</span>) sont obligatoires
                </div>
            </div>
            <div class="boutons">
                <button type="submit">Valider</button>
            </div>
        </form>
    </div>
@endsection
