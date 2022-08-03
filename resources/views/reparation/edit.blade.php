@extends('template.primary')

@section('titre')
    Modification de la réparation
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    <div class="container">
        <form action="{{ route('reparation.update', $reparation->id) }}" method="post">
            @csrf
            @method('put')
            <div class="container mt-3">
                <h3 class="text-center">Modifier la réparation</h3>
            </div>
            <div class="row border rounded-5 p-4 mb-4 mt-4 shadow" id="conteneur_form_article">

                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label class="form-label">Panne <span class="text-danger"> *</span></label>
                        <select required class="form-select @error('panne') is-invalid @enderror" name="panne">
                            <option value="">Choisissez la panne</option>
                            @foreach ($pannes as $panne)
                                <option @if($reparation->panne_id == $panne->id) {{ 'selected' }}@endif value="{{ $panne->id }}">{{ $panne->code }} | N° Immat : {{ $panne->vehicule->immatriculation }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            @error('panne')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="date">Date de réparation <span class="text-danger"> *</span></label>
                        <input required class="form-control @error('date') is-invalid @enderror" type="date" name="date" id="date"
                            value="{{ old('date', $reparation->date) }}">
                        <div class="invalid-feedback">
                            @error('date')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="montant">Montant <span class="text-danger"> *</span></label>
                        <input required class="form-control @error('montant') is-invalid @enderror" type="number"
                            name="montant" id="montant" value="{{ old('montant', $reparation->montant) }}" min="0">
                        <div class="invalid-feedback">
                            @error('montant')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label class="form-label" for="observation">Observation</label>
                        <input class="form-control @error('observation') is-invalid @enderror" type="text"
                        name="observation" id="observation" value="{{ old('observation', $reparation->observation) }}">
                        <div class="invalid-feedback">
                            @error('observation')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="agent_reparation">Agent de réparation <span class="text-danger"> *</span></label>
                        <input required class="form-control @error('agent_reparation') is-invalid @enderror" type="text" name="agent_reparation" id="agent_reparation"
                            value="{{ old('agent_reparation', $reparation->agent_reparation) }}">
                        <div class="invalid-feedback">
                            @error('agent_reparation')
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
