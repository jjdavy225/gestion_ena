@extends('template.primary')

@section('titre')
    Création de stock
@endsection

@section('contenu')
    <div class="container mt-3">
        <h3 class="text-center">Renseignez le nouveau stock</h3>
    </div>
    <div class="container">
        <form method="POST" action="{{route('stock.store')}}">
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
                    {{-- <div class="form-group mb-3">
                        <label class="form-label" for="entree">Entrée</label>
                        <input class="form-control" type="number" name="entree" id="entree" value="{{ old('entree') }}">
                        @error('entree')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="sortie">Sortie</label>
                        <input class="form-control" type="number" name="sortie" id="sortie"
                            value="{{ old('sortie') }}">
                        @error('num_fact')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="retour">Retour</label>
                        <input class="form-control" type="number" name="retour" id="retour"
                            value="{{ old('retour') }}">
                        @error('retour')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="stock">Stock</label>
                        <input class="form-control" type="number" name="stock" id="stock" value="{{ old('stock') }}">
                        @error('stock')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <div class="form-group mb-3">
                        <label class="form-label" for="exercice_code">Code d'exercice</label>
                        <input class="form-control" type="text" name="exercice_code" id="exercice_code"
                            value="{{ old('exercice_code') }}">
                        @error('exercice_code')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="form-group mb-3">
                        <label class="form-label" for="jour">Jour</label>
                        <input class="form-control" type="date" name="jour" id="jour"
                            value="{{ old('jour') }}">
                        @error('jour')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div> --}}
                </div>
                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label class="form-label" for="nature">Nature</label>
                        <input class="form-control" type="text" name="nature" id="nature" value="{{ old('nature') }}">
                        @error('nature')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="montant_initial">Montant initial</label>
                        <input class="form-control" type="number" name="montant_initial" id="montant_initial"
                            value="{{ old('montant_initial') }}">
                        @error('montant_initial')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="form-group mb-3">
                        <label class="form-label" for="entree_montant">Montant des entrées</label>
                        <input class="form-control" type="number" name="entree_montant" id="entree_montant"
                            value="{{ old('entree_montant') }}">
                        @error('entree_montant')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="assemble_montant">Montant assemble ?</label>
                        <input class="form-control" type="number" name="assemble_montant" id="assemble_montant"
                            value="{{ old('assemble_montant') }}">
                        @error('assemble_montant')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="sortie_montant">Montant des sorties</label>
                        <input class="form-control" type="number" name="sortie_montant" id="sortie_montant"
                            value="{{ old('sortie_montant') }}">
                        @error('sortie_montant')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="retour_montant">Montant des retours</label>
                        <input class="form-control" type="number" name="retour_montant" id="retour_montant"
                            value="{{ old('retour_montant') }}">
                        @error('retour_montant')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="stock_montant">Montant des stocks</label>
                        <input class="form-control" type="number" name="stock_montant" id="stock_montant"
                            value="{{ old('stock_montant') }}">
                        @error('stock_montant')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div> --}}
                </div>
                <input class="btn btn-dark col-lg-2 offset-5" type="submit" value="Soumettre">
            </div>
        </form>

    </div>
@endsection
