@extends('template.primary')

@section('titre')
    Nouvel article
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    <div class="container">
        <form action="{{ route('article.store') }}" method="post">
            @csrf
            <div class="container mt-3">
                <h3 class="text-center">Renseignez les infos du nouvel article</h3>
            </div>
            <div class="row border rounded-5 p-4 mb-4 mt-4 shadow" id="conteneur_form_article">

                <div class="toChange form-group mb-3">
                    <label class="toChangeLabel form-label">Type de l'article</label>
                    <select required class="selectChanger form-select" name="type">
                        <option value="">Choisissez un type</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->designation }}</option>
                        @endforeach
                        <option class="new" value="new">Nouveau type</option>
                    </select>
                    @error('type')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="designation">Désignation</label>
                    <input required class="form-control" type="text" name="designation" id="designation"
                        value="{{ old('designation') }}">
                    @error('designation')
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
                        labels[i].innerHTML = 'Désignation du nouveau type' +
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
                            if (i == 0) {
                                selects[i].setAttribute('name', 'newType')
                            } else {
                                selects[i].setAttribute('name', 'newMarque')
                            }
                            newOption.innerHTML = this.value
                            newOption.setAttribute('selected', '')
                            selects[i].insertBefore(newOption, optionNew[i])
                            labels[i].innerHTML = labelPrevious
                            selects[i].style.display = 'block'
                            selects[i].addEventListener('change', (function() {
                                if (this.value === newOption.value) {
                                    if (i == 0) {
                                        selects[i].setAttribute('name', 'newType')
                                    } else {
                                        selects[i].setAttribute('name', 'newMarque')
                                    }
                                }
                            }))
                        }
                    }))
                } else {
                    if (i == 0) {
                        selects[i].setAttribute('name', 'type')
                    } else {
                        selects[i].setAttribute('name', 'marque')
                    }
                }
            }))
        }
    </script>
@endsection
