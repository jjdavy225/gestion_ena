@extends('template.primary')

@section('titre')
    Nouvelle affectation
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    <div class="container">
        <form action="{{ route('affectation.update', $affectation->id) }}" method="post">
            @csrf
            @method('put')
            <div class="container mt-3">
                <h3 class="text-center">Modifier les infos de l'affectation</h3>
            </div>
            <div class="row border rounded-5 p-4 mb-4 mt-4 shadow" id="conteneur_form_article">

                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label class="form-label" for="conducteur_principal">Conducteur principal<span class="text-danger">
                                *</span></label>
                        <select id="conducteur_principal" required
                            class="form-select @error('conducteur_principal') is-invalid @enderror"
                            name="conducteur_principal">
                            <option value="">Choisissez le conducteur</option>
                            @foreach ($conducteurs as $conducteur)
                                <option value="{{ $conducteur->id }}"
                                    @if ($conducteur->id == old('conducteur_principal', $affectation->conducteur_principal_id)) {{ 'selected' }} @endif>
                                    {{ $conducteur->agent_conducteur->nom . ' ' . $conducteur->agent_conducteur->prenom }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            @error('conducteur_principal')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="conducteur_secondaire">Conducteur secondaire</label>
                        <select id="conducteur_secondaire"
                            class="form-select @error('conducteur_secondaire') is-invalid @enderror"
                            name="conducteur_secondaire">
                            <option value="">Choisissez le conducteur</option>
                            @foreach ($conducteurs as $conducteur)
                                <option value="{{ $conducteur->id }}"
                                    @if ($conducteur->id == old('conducteur_secondaire', $affectation->conducteur_secondaire_id)) {{ 'selected' }} @endif>
                                    {{ $conducteur->agent_conducteur->nom . ' ' . $conducteur->agent_conducteur->prenom }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            @error('conducteur_secondaire')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="date_debut">Date de début<span class="text-danger"> *</span></label>
                        <input required class="form-control @error('date_debut') is-invalid @enderror" type="date"
                            name="date_debut" id="date_debut" value="{{ old('date_debut', $affectation->date_debut) }}">
                        <div class="invalid-feedback">
                            @error('date_debut')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="date_fin">Date de fin<span class="text-danger"> *</span></label>
                        <input required class="form-control @error('date_fin') is-invalid @enderror" type="date"
                            name="date_fin" id="date_fin" value="{{ old('date_fin', $affectation->date_fin_prevue) }}">
                        <div class="invalid-feedback">
                            @error('date_fin')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label class="form-label" for="vehicule">Véhicule<span class="text-danger"> *</span></label>
                        <select id="vehicule" required class="form-select @error('vehicule') is-invalid @enderror"
                            name="vehicule">
                            <option value="">Choisissez le véhicule</option>
                            @foreach ($vehicules as $vehicule)
                                <option value="{{ $vehicule->id }}"
                                    @if ($vehicule->id == old('vehicule', $affectation->vehicule_id)) {{ 'selected' }} @endif>
                                    {{ $vehicule->modele->designation }} {{ $vehicule->marque_vehicule->designation }}
                                    N° {{ $vehicule->immatriculation }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            @error('vehicule')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="direction">Direction</label>
                        <input class="form-control @error('direction') is-invalid @enderror" type="text"
                            name="direction" id="direction" value="{{ old('direction', $affectation->direction) }}">
                        <div class="invalid-feedback">
                            @error('direction')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="service">Service</label>
                        <input required class="form-control @error('service') is-invalid @enderror" type="text"
                            name="service" id="service" value="{{ old('service', $affectation->service) }}">
                        <div class="invalid-feedback">
                            @error('service')
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
    <script src="{{ asset('js/app1.js') }}"></script>
@endsection
