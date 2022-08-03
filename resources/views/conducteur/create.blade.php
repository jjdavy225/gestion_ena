@extends('template.primary')

@section('titre')
    Nouveau conducteur
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    <div class="container">
        <form action="{{ route('conducteur.store') }}" method="post">
            @csrf
            <div class="container mt-3">
                <h3 class="text-center">Renseigner les infos du conducteur</h3>
            </div>
            <div class="row border rounded-5 p-4 mb-4 mt-4 shadow" id="conteneur_form_article">

                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label class="form-label">Agent conducteur <span class="text-danger"> *</span></label>
                        <select required class="form-select @error('agent_conducteur') is-invalid @enderror"
                            name="agent_conducteur">
                            <option value="">Choisissez l'agent</option>
                            @foreach ($agents as $agent)
                                @if ($agent->conducteur_info == null)
                                    <option value="{{ $agent->id }}" @if($agent->id == old('agent_conducteur')) {{ 'selected' }}@endif>{{ $agent->nom . ' ' . $agent->prenom }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            @error('agent_conducteur')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="type_permis">Type de permis <span class="text-danger">
                                *</span></label>
                        <input required class="form-control @error('type_permis') is-invalid @enderror"  type="text"
                            name="type_permis" id="type_permis" value="{{ old('type_permis') }}">
                        <div class="invalid-feedback">
                            @error('type_permis')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label class="form-label" for="numero_permis">Numéro du permis <span class="text-danger">
                                *</span></label>
                        <input required class="form-control @error('numero_permis') is-invalid @enderror" type="text"
                            name="numero_permis" id="numero_permis" value="{{ old('numero_permis') }}">
                        <div class="invalid-feedback">
                            @error('numero_permis')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="validite_permis">Date de fin de validité du permis <span
                                class="text-danger"> *</span></label>
                        <input required class="form-control @error('validite_permis') is-invalid @enderror" type="date"
                            name="validite_permis" id="validite_permis" value="{{ old('validite_permis') }}">
                        <div class="invalid-feedback">
                            @error('validite_permis')
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
