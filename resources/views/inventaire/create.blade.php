@extends('template.primary')

@section('titre')
    Nouvel inventaire
@endsection

@section('contenu')
    <div class="container mt-3">
        <h3 class="text-center">Renseignez l'inventaire</h3>
    </div>
    <div class="container">
        <form method="POST" action="{{ route('inventaire.store') }}">
            @csrf
            <div class="row border rounded-5 p-4 mb-4 mt-4 shadow">
                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label class="form-label" for="initial">Initial</label>
                        <input class="form-control" type="number" name="initial" id="initial"
                            value="{{ old('initial') }}">
                        @error('initial')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="physique">Physique</label>
                        <input class="form-control" type="number" name="physique" id="physique" value="{{ old('physique') }}">
                        @error('physique')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="final">Final</label>
                        <input class="form-control" type="number" name="final" id="final" value="{{ old('final') }}">
                        @error('final')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label class="form-label" for="maj">Mise à jour</label>
                        <input class="form-control" type="number" name="maj" id="maj" value="{{ old('maj') }}">
                        @error('maj')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="exercice_code">Code d'exercice</label>
                        <input class="form-control" type="text" name="exercice_code" id="exercice_code"
                            value="{{ old('exercice_code') }}">
                        @error('exercice_code')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="nature">Nature</label>
                        <input class="form-control" type="text" name="nature" id="nature" value="{{ old('nature') }}">
                        @error('nature')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <input class="btn btn-dark col-lg-2 offset-5" type="submit" value="Soumettre">
            </div>
        </form>

    </div>
@endsection
