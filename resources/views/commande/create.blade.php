@extends('template.primary')

@section('titre')
    Enregistrement d'une commande
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    {{-- Forrmulaire de création nouvel article --}}
    @if (Session::has('info'))
        <div class="alert alert-primary">
            {{ Session::get('info') }}
        </div>
    @endif
    <div class="container" style="display: none;" id="new_article_form">
        @if ($errors->has('type') || $errors->has('marque') || $errors->has('designation'))
            <script type="text/javascript">
                document.getElementById('new_article_form').style.display = 'block';
            </script>
        @endif

        <form action="{{ route('article.store') }}" method="post">
            @csrf
            <div class="container mt-3">
                <h3 class="text-center">Renseignez les infos du nouvel article</h3>
            </div>
            <div class="row border rounded-5 p-4 mb-4 mt-4 shadow" id="conteneur_form_article">

                <div class="form-group mb-3">
                    <label class="form-label" class="label">Type de l'article</label>
                    <select class="form-select" name="type">
                        <option disabled selected>Choisissez un type</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->designation }}
                            </option>
                        @endforeach
                    </select>
                    @error('type')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="designation">Désignation</label>
                    <input class="form-control" type="text" name="designation" id="designation"
                        value="{{ old('designation') }}">
                    @error('designation')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Marque</label>
                    <select class="form-select" name="marque">
                        <option disabled selected>Choisissez une marque</option>
                        @foreach ($marques as $marque)
                            <option value="{{ $marque->id }}">{{ $marque->designation }}
                            </option>
                        @endforeach
                    </select>
                    @error('marque')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="boutons">
                    <input id="new_article_valider" type="submit" class="btn btn-dark col-lg-2 shadow-sm" value="Valider">
                    <button type="button" id="fermer_new_article">Annuler</button>
                    <script type="text/javascript">
                        document.getElementById('fermer_new_article').addEventListener("click", (function() {
                            document.getElementById('new_article_form').style.display = 'none';
                        }))
                    </script>
                </div>

            </div>
        </form>
    </div>

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
                                            articles['{{ $article->code }}'] = '{{ $article->designation }}'+' '+'{{$article->marque->designation}}';
                                        </script>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="boutons">
                        <button type="button" id="activ_js">Ok</button>
                        <button type="button" id="activ_js_new_article">Nouvel article</button>
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
                                        '</label><div class="row"><div class="col-lg-6"><input class="form-control" type="number" name="qtes[]" placeholder="Quantité" required></div><div class="col-lg-6"><input class="form-control" type="number" name="pu_s[]" placeholder="Prix unitaire" required></div></div></div>'
                                    document.getElementById('submit_all_js').innerHTML =
                                        '<input class="btn btn-dark col-lg-2 offset-5 shadow-sm" type="submit" value="Valider">'
                                }
                            }
                            if (!a) {
                                texte.innerHTML =
                                    '<h5 class="text-center" style="color:red;">CHOISSSEZ AU MOINS UN ARTICLE</h5>';
                                document.getElementById('submit_all_js').innerHTML = '';
                            }
                        }))
                        document.getElementById('activ_js_new_article').addEventListener("click", (function() {
                            form.style.display = 'block';
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
                            <input class="form-control" type="date" name="date" id="date" value="{{ old('date') }}">
                            @error('date')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="objet">Objet de la commande</label>
                            <input class="form-control" type="text" name="objet" id="objet" value="{{ old('objet') }}">
                            @error('objet')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="num_fact">Numéro de la facture</label>
                            <input class="form-control" type="text" name="num_fact" id="num_fact"
                                value="{{ old('num_fact') }}">
                            @error('num_fact')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="date_fact">Date de la facture</label>
                            <input class="form-control" type="date" name="date_fact" id="date_fact"
                                value="{{ old('date_fact') }}">
                            @error('date_fact')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="remise">Remise</label>
                            <input class="form-control" type="number" name="remise" id="remise"
                                value="{{ old('remise') }}">
                            @error('remise')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="tva">Taux de valeur ajoutée</label>
                            <input class="form-control" type="number" name="tva" id="tva" value="{{ old('tva') }}">
                            @error('tva')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="montant">Montant</label>
                            <input class="form-control" type="number" name="montant" id="montant"
                                value="{{ old('montant') }}">
                            @error('montant')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="delai_paie">Delai de paiement</label>
                            <input class="form-control" type="number" name="delai_paie" id="delai_paie"
                                value="{{ old('delai_paie') }}">
                            @error('delai_paie')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="delai_liv">Delai de livraison</label>
                            <input class="form-control" type="number" name="delai_liv" id="delai_liv"
                                value="{{ old('delai_liv') }}">
                            @error('delai_liv')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="date_liv">Date de livraison</label>
                            <input class="form-control" type="date" name="date_liv" id="date_liv"
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
                            <label class="form-label">Agent</label>
                            <select class="form-select" name="agent">
                                <option disabled selected>Choisissez un agent</option>
                                @foreach ($agents as $agent)
                                    <option value="{{ $agent->id }}">{{ $agent->nom }} {{ $agent->prenom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('agent')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="frais">Frais</label>
                            <input class="form-control" type="number" name="frais" id="frais"
                                value="{{ old('frais') }}">
                            @error('frais')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="garantie">Garantie</label>
                            <input class="form-control" type="number" name="garantie" id="garantie"
                                value="{{ old('garantie') }}">
                            @error('garantie')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div id="submit_all_js"></div>
            </form>
        </div>
    </div>
@endsection
