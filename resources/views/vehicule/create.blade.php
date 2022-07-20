@extends('template.primary')

@section('titre')
    Nouveau véhicule
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    <div class="container">
        <form action="{{ route('vehicule.store') }}" method="post">
            @csrf
            <div class="container mt-3">
                <h3 class="text-center">Renseignez les infos du nouveau véhicule</h3>
            </div>
            <div class="row border rounded-5 p-4 mb-4 mt-4 shadow" id="conteneur_form_article">

                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label class="form-label" for="immatriculation">N° immatriculation</label>
                        <input required class="form-control" type="text" name="immatriculation" id="immatriculation"
                            value="{{ old('immatriculation') }}">
                        @error('immatriculation')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="carte_grise">N° carte grise</label>
                        <input required class="form-control" type="text" name="carte_grise" id="carte_grise"
                            value="{{ old('carte_grise') }}">
                        @error('carte_grise')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="chassis">N° châssis</label>
                        <input required class="form-control" type="text" name="chassis" id="chassis"
                            value="{{ old('chassis') }}">
                        @error('chassis')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="date_circulation">Date de mise en circulation</label>
                        <input required class="form-control" type="date" name="date_circulation" id="date_circulation"
                            value="{{ old('date_circulation') }}">
                        @error('date_circulation')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="toChange form-group mb-3">
                        <label class="toChangeLabel form-label">Type d'acquisition</label>
                        <select required class="selectChanger form-select" name="type_acquisition">
                            <option value="">Choisissez un type</option>
                            @foreach (App\Models\Vehicule::distinct()->pluck('type_acquisition') as $type)
                                <option>{{ $type }}</option>
                            @endforeach
                            <option class="new" value="new">Nouveau type d'acquisition</option>
                        </select>
                        @error('type_acquisition')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label class="form-label" for="date_acquisition">Date d'acquisition</label>
                        <input required class="form-control" type="date" name="date_acquisition" id="date_acquisition"
                            value="{{ old('date_acquisition') }}">
                        @error('date_acquisition')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="kilometrage">Kilométrage au compteur (0 par défaut)</label>
                        <input class="form-control" type="number" name="kilometrage"
                            id="kilometrage" value="{{ old('kilometrage', '0') }}">
                        @error('kilometrage')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Fournisseur</label>
                        <select required class="form-select" name="fournisseur">
                            <option value="">Choisissez un fournisseur</option>
                            @foreach ($fournisseurs as $fournisseur)
                                <option value="{{ $fournisseur->id }}">{{ $fournisseur->sigle }}</option>
                            @endforeach
                        </select>
                        @error('fournisseur')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Modèle</label>
                        <select required class="form-select" name="modele">
                            <option value="">Choisissez un modèle</option>
                            @foreach ($modeles as $modele)
                                <option value="{{ $modele->id }}">{{ $modele->designation }}</option>
                            @endforeach
                        </select>
                        @error('modele')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="toChange form-group mb-3">
                        <label class="toChangeLabel form-label">Marque</label>
                        <select required class="selectChanger form-select" name="marque">
                            <option value="">Choisissez une marque</option>
                            @foreach ($marques as $marque)
                                <option value="{{ $marque->id }}">{{ $marque->designation }}</option>
                            @endforeach
                            <option class="new" value="new">Nouvelle marque</option>
                        </select>
                        @error('marque')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="boutons">
                <button type="submit">Valider</button>
            </div>
        </form>
    </div>
    <script>
        var selects = document.getElementsByClassName('selectChanger')
        var labels = document.getElementsByClassName('toChangeLabel')
        var divToChange = document.getElementsByClassName('toChange')
        var optionNew = document.getElementsByClassName('new')
        for (let i = 0; i < selects.length; i++) {
            selects[i].addEventListener('change', (function() {
                if (this.value === 'new') {
                    this.style.display = 'none'
                    var labelPrevious = labels[i].innerHTML
                    if (i == 0) {
                        labels[i].innerHTML = 'Nouveau type d\'acquisition' +
                            '<button class="btn btn-outline-dark btn-sm ms-3" title="Annuler" type="button"><i class="fa-solid fa-circle-xmark"></i></button>'
                    } else {
                        labels[i].innerHTML = 'Désignation de la nouvelle marque' +
                            '<button class="btn btn-outline-dark btn-sm ms-3" title="Annuler" type="button"><i class="fa-solid fa-circle-xmark"></i></button>'
                    }
                    var newTypeField = document.createElement('input');
                    newTypeField.setAttribute('class', 'form-control')
                    newTypeField.setAttribute('required', '')
                    newTypeField.setAttribute('type', 'text')
                    newTypeField.setAttribute('maxlength', 30)
                    divToChange[i].appendChild(newTypeField);
                    newTypeField.focus()
                    labels[i].querySelector('button').addEventListener('click', (function() {
                        labels[i].innerHTML = labelPrevious
                        newTypeField.remove()
                        selects[i].style.display = 'block'
                        selects[i].querySelector("option").selected = true
                    }))
                    newTypeField.addEventListener('change', (function() {
                        newTypeField.remove()
                        var options = selects[i].querySelectorAll("option")
                        var optionBool = false
                        for (let i = 0; i < options.length; i++) {
                            if (options[i].innerHTML.toLowerCase() === this.value.toLowerCase()) {
                                options[i].selected = true
                                labels[i].innerHTML = labelPrevious
                                selects[i].style.display = 'block'
                                optionBool = true
                                break
                            }
                        }
                        if (!optionBool) {
                            var newOption = document.createElement('option')
                            if (i != 0) {
                                selects[i].setAttribute('name', 'newMarque')
                            }
                            newOption.innerHTML = this.value
                            newOption.setAttribute('selected', '')
                            selects[i].insertBefore(newOption, optionNew[i])
                            labels[i].innerHTML = labelPrevious
                            selects[i].style.display = 'block'
                            selects[i].addEventListener('change', (function() {
                                if (this.value === newOption.value) {
                                    if (i != 0) {
                                        selects[i].setAttribute('name', 'newMarque')
                                    }
                                }
                            }))
                        }
                    }))
                } else {
                    if (i != 0) {
                        selects[i].setAttribute('name', 'marque')
                    }
                }
            }))
        }
    </script>
@endsection
