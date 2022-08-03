@extends('template.primary')

@section('titre')
    Nouvelle panne
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    <div class="container">
        <form action="{{ route('panne.store') }}" method="post">
            @csrf
            <div class="container mt-3">
                <h3 class="text-center">Renseignez les infos de la panne</h3>
            </div>
            <div class="row border rounded-5 p-4 mb-4 mt-4 shadow" id="conteneur_form_article">

                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label class="form-label">Véhicule <span class="text-danger"> *</span></label>
                        <select required class="form-select @error('vehicule') is-invalid @enderror" name="vehicule">
                            <option value="">Choisissez le véhicule</option>
                            @foreach ($vehicules as $vehicule)
                                <option value="{{ $vehicule->id }}">{{ $vehicule->immatriculation }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            @error('vehicule')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="causes">Causes <span class="text-danger"> *</span></label>
                        <input required class="form-control @error('causes') is-invalid @enderror" type="text"
                            name="causes" id="causes" value="{{ old('causes') }}">
                        <div class="invalid-feedback">
                            @error('causes')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="vehicule_utilisable">Le véhicule est-il en état de rouler ? <span class="text-danger"> *</span></label>
                        <select class="form-select" name="vehicule_utilisable">
                            <option value="">Choisissez</option>
                            <option value="1">Oui</option>
                            <option value="0">Non</option>
                        </select>
                        <div class="invalid-feedback">
                            @error('vehicule_utilisable')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label class="form-label" for="observation">Observation</label>
                        <input class="form-control @error('observation') is-invalid @enderror" type="text"
                            name="observation" id="observation" value="{{ old('observation') }}">
                        <div class="invalid-feedback">
                            @error('observation')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="degats">Dégâts <span class="text-danger"> *</span></label>
                        <input required class="form-control @error('degats') is-invalid @enderror" type="text" name="degats" id="degats"
                            value="{{ old('degats') }}">
                        <div class="invalid-feedback">
                            @error('degats')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="date_panne">Date de panne <span class="text-danger"> *</span></label>
                        <input required class="form-control @error('date_panne') is-invalid @enderror" type="date" name="date_panne" id="date_panne"
                            value="{{ old('date_panne') }}">
                        <div class="invalid-feedback">
                            @error('date_panne')
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
