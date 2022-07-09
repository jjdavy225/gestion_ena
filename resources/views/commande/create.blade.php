@extends('template.primary')

@section('titre')
    Nouvelle commande
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    {{-- @if (Session::has('info'))
        <div class="alert alert-primary">
            {{ Session::get('info') }}
        </div>
    @endif --}}

    {{-- Début de la page create --}}
    <div class="container-fluid">
        <div class="container">
            <form action="{{ route('commande.store') }}" method="post">
                @csrf
                <h3 class="text-center">Choisissez vos articles</h3>
                <div class="form-group mb-3">
                    <div class="container" id="table_liste_article">
                        <table class="table table-success table-stripped">
                            <thead>
                                <tr>
                                    <th>Articles</th>
                                    <th>Marque</th>
                                    <th>Choix</th>
                                </tr>
                            </thead>
                            <tbody>
                                <script type="text/javascript">
                                    let articles = {};
                                </script>
                                @foreach ($articles as $article)
                                    <tr>
                                        <td>{{ $article->designation }}</td>
                                        <td>{{ $article->marque->designation }}</td>
                                        <td><input class="checkbox styled checkbox-primary" id="{{ $article->code }}"
                                                type="checkbox" name="articles[]" value="{{ $article->id }}"
                                                {{ in_array($article->id, old('articles') ?: []) ? 'checked' : '' }}>
                                        </td>
                                        <script type="text/javascript">
                                            articles['{{ $article->code }}'] = '{{ $article->designation }}' + ' ' +
                                                '{{ $article->marque->designation }}';
                                        </script>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="boutons">
                        <button type="button" id="activ_js">Ok</button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#new_article_form">Nouvel
                            article</button>
                    </div>

                    <div id="liste_article"></div>

                    <script type="text/javascript">
                        let texte = document.getElementById('liste_article');
                        let form = document.getElementById('new_article_form');
                        document.getElementById('activ_js').addEventListener("click", (function() {
                            let a = false;
                            texte.innerHTML = '<h5 class = "text-center mt-2">Entrer les quantités et les prix unitaires</h5>'
                            for (let article in articles) {
                                if (document.getElementById(article).checked == true) {
                                    a = true;
                                    texte.innerHTML += '<div class="form-group mb-3"><label class="form-label">' + articles[
                                            article] +
                                        '</label><div class="row"><div class="col-lg-6"><input class="form-control" type="number" min="0" name="qtes[]" placeholder="Quantité" required></div><div class="col-lg-6"><input class="form-control" type="number" min="0" name="pu_s[]" placeholder="Prix unitaire" required></div></div></div>'
                                    document.getElementById('submit_all_js').innerHTML =
                                        '<input class="btn btn-danger col-lg-2" type="submit" value="Valider">'
                                }
                            }
                            if (!a) {
                                texte.innerHTML =
                                    '<h5 class="text-center" style="color:red;">CHOISSSEZ AU MOINS UN ARTICLE</h5>';
                                document.getElementById('submit_all_js').innerHTML = '';
                            }
                        }))
                    </script>
                </div>

                <div class="container mt-3">
                    <h3 class="text-center">Renseignez votre commande</h3>
                </div>

                <div class="row border rounded-5 p-4 mb-4 mt-4 shadow">
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="date">Date de commande</label>
                            <input required class="form-control" type="date" name="date" id="date"
                                value="{{ old('date') }}">
                            @error('date')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="objet">Objet de la commande</label>
                            <input required class="form-control" type="text" name="objet" id="objet"
                                value="{{ old('objet') }}">
                            @error('objet')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="num_fact">Numéro de la facture</label>
                            <input required class="form-control" type="text" name="num_fact" id="num_fact"
                                value="{{ old('num_fact') }}">
                            @error('num_fact')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="date_fact">Date de la facture</label>
                            <input required class="form-control" type="date" name="date_fact" id="date_fact"
                                value="{{ old('date_fact') }}">
                            @error('date_fact')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="remise">Remise</label>
                            <input required class="form-control" type="number" min="0" name="remise" id="remise"
                                value="{{ old('remise') }}">
                            @error('remise')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="tva">Taux de valeur ajoutée</label>
                            <input required class="form-control" type="number" min="0" name="tva" id="tva"
                                value="{{ old('tva') }}">
                            @error('tva')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="montant">Montant</label>
                            <input required class="form-control" type="number" min="0" name="montant" id="montant"
                                value="{{ old('montant') }}">
                            @error('montant')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="delai_paie">Delai de paiement</label>
                            <input required class="form-control" type="number" min="0" name="delai_paie"
                                id="delai_paie" value="{{ old('delai_paie') }}">
                            @error('delai_paie')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="delai_liv">Delai de livraison</label>
                            <input required class="form-control" type="number" min="0" name="delai_liv"
                                id="delai_liv" value="{{ old('delai_liv') }}">
                            @error('delai_liv')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="date_liv">Date de livraison</label>
                            <input required class="form-control" type="date" name="date_liv" id="date_liv"
                                value="{{ old('date_liv') }}">
                            @error('date_liv')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" class="label">Fournisseur</label>
                            <select class="form-select" name="fournisseur">
                                <option disabled selected>Choisissez un fournisseur</option>
                                @foreach ($fournisseurs as $fournisseur)
                                    <option value="{{ $fournisseur->id }}">{{ $fournisseur->sigle }}</option>
                                @endforeach
                            </select>
                            @error('fournisseur')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="frais">Frais</label>
                            <input required class="form-control" type="number" min="0" name="frais"
                                id="frais" value="{{ old('frais') }}">
                            @error('frais')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="garantie">Garantie</label>
                            <input required class="form-control" type="number" min="0" name="garantie"
                                id="garantie" value="{{ old('garantie') }}">
                            @error('garantie')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="boutons" id="submit_all_js"></div>
            </form>
        </div>
    </div>

    {{-- Forrmulaire de création nouvel article --}}

    <div class="modal fade" id="new_article_form" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="container mt-3">
                        <h4 class="text-center">Renseignez les infos du nouvel article</h4>
                    </div><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('article.store') }}" method="post">
                        @csrf
                        <div class="row mb-4 mt-2" id="conteneur_form_article">

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
            </div>
        </div>
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
                    newTypeField.setAttribute('maxlength', 25)
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
                            seloffset-5 shadow-smects[i].addEventListener('change', (function() {
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
    @if ($errors->has('type') || $errors->has('marque') || $errors->has('designation'))
        <script type="text/javascript">
            var myModal = new bootstrap.Modal(document.getElementById("new_article_form"), {});
            document.onreadystatechange = function() {
                myModal.show();
            };
        </script>
    @endif
@endsection
