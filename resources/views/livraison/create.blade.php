@extends('template.primary')

@section('titre')
    Livraison
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    <div class="container-fluid">
        <div class="container">
            <form action="{{ route('livraison.store') }}" method="post">
                @csrf

                <div class="container mt-3">
                    <h3 class="text-center">Renseignez la livraison</h3>
                </div>

                <div class="container" id="conteneur_type">
                    <h5 class="text-center">Choisissez le type de livraison</h5>
                    <div id="type_liv">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="liv" value="complete" id="complete">
                            <label class="form-check-label" for="complete">complète (tous les articles commandés)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="liv" value="partielle" id="partielle">
                            <label class="form-check-label" for="partielle">partielle</label>
                        </div>
                    </div>
                </div>

                <div class="row border rounded-5 p-4 mb-4 mt-4 shadow">
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="date">Date</label>
                            <input class="form-control" type="date" name="date" id="date" value="{{ old('date') }}">
                            @error('date')
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
                        <div class="form-group mb-3">
                            <label class="form-label" for="delai">Delai</label>
                            <input class="form-control" type="number" name="delai" id="delai"
                                value="{{ old('delai') }}">
                            @error('delai')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="commande">Commande</label>
                            <select class="form-select" name="commande" id="commande">
                                <script>
                                    let commandes = {};
                                </script>
                                <option disabled selected>Choisissez une commande</option>
                                @foreach ($commandes as $commande)
                                    @if ($commande->statut_liv != 'Livrée')
                                        <option value="{{ $commande->id }}">Code : {{ $commande->num }} |Objet :
                                            {{ $commande->objet }}</option>
                                        <script>
                                            commandes['{{ $commande->id }}'] = {};
                                        </script>
                                        @foreach ($commande->articles as $article)
                                            <script>
                                                commandes['{{ $commande->id }}']['{{ $article->designation }} {{$article->marque->designation}}'] = ['{{ $article->id }}',
                                                    '{{ $article->pivot->reste }}'
                                                ]
                                            </script>
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                            @error('commande')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        {{-- <div class="form-group mb-3">
                            <label class="form-label" for="agent">Agent</label>
                            <select class="form-select" name="agent" id="agent">
                                <option disabled selected>Choisissez un agent</option>
                                @foreach ($agents as $agent)
                                    <option value="{{ $agent->id }}">{{ $agent->nom }} {{ $agent->prenom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('agent')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div> --}}
                        <div class="form-group mb-3">
                            <label class="form-label" for="stock">Stock</label>
                            <select class="form-select" name="stock" id="stock">
                                <option disabled selected>Choisissez le stock</option>
                                @foreach ($stocks as $stock)
                                    <option value="{{ $stock->id }}">{{ $stock->nature }}</option>
                                @endforeach
                            </select>
                            @error('stock')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="num_bon">Numéro de bon</label>
                            <input class="form-control" type="text" name="num_bon" id="num_bon"
                                value="{{ old('num_bon') }}">
                            @error('num_bon')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="date_bon">Date de bon</label>
                            <input class="form-control" type="date" name="date_bon" id="date_bon"
                                value="{{ old('date_bon') }}">
                            @error('date_bon')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="fact_num">Numéro de la facture</label>
                            <input class="form-control" type="text" name="fact_num" id="fact_num"
                                value="{{ old('fact_num') }}">
                            @error('fact_num')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="fact_date">Date de la facture</label>
                            <input class="form-control" type="date" name="fact_date" id="fact_date"
                                value="{{ old('fact_date') }}">
                            @error('fact_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class="form-group mb-3" id="tab_article" style="display: none">
                    <script>
                        if (document.getElementById('partielle').checked) {
                            document.getElementById('tab_article').style.display = 'block'
                        }
                    </script>
                    <div class="container" id="table_liste_article">
                        <table class="table table-success table-stripped">
                            <thead>
                                <tr>
                                    <th>Articles</th>
                                    <th>Choix</th>
                                </tr>
                            </thead>
                            <tbody id="tab_choix_js">
                                <script type="text/javascript">
                                    const doc = document.getElementById('commande');
                                    const doc2 = document.getElementById('tab_choix_js');
                                    tab_choix(commandes[doc.value], doc2);
                                    doc.addEventListener('change', (function() {
                                        var articles_c = commandes[doc.value];
                                        tab_choix(articles_c, doc2);
                                    }))

                                    function tab_choix(articles, doc) {
                                        doc.innerHTML = ""
                                        for (var designation in articles) {
                                            var id = articles[designation][0]
                                            var reste = articles[designation][1]
                                            if (reste > 0) {
                                                doc.innerHTML += '<tr><td>' + designation +
                                                    '</td><td><input class="checkbox styled checkbox-primary" id="' + designation +
                                                    '"type="checkbox" name="articles[]" value="' + id + '"></td></tr>';
                                            }
                                        }
                                    }
                                </script>
                            </tbody>
                        </table>
                    </div>
                    <div class="boutons">
                        <button type="button" id="activ_js">Ok</button>
                    </div>

                    <div id="liste_article"></div>

                    <script type="text/javascript">
                        let texte = document.getElementById('liste_article');
                        document.getElementById('activ_js').addEventListener("click", (function() {
                            let a = false;
                            var articles_c = commandes[doc.value];
                            texte.innerHTML = '<h5 class = "text-center mt-2">Entrer les quantités livrées</h5>'
                            for (let designation in articles_c) {
                                var reste = articles_c[designation][1];
                                if (reste > 0) {
                                    if (document.getElementById(designation).checked == true) {
                                        a = true;
                                        texte.innerHTML +=
                                            '<div class="form-group mb-3 col-lg-6" style="margin-left:auto;margin-right:auto;"><label class="form-label">' +
                                            designation +
                                            '</label><input class="form-control" type="number" name="qtes[]" placeholder="Restant : '+ reste +'" required max="' +
                                            reste + '"></div>'
                                        document.getElementById('submit_all_js').innerHTML =
                                            '<input class="btn btn-dark col-lg-2 offset-5" type="submit" value="Soumettre">'
                                    }
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
                <div id="submit_all_js">
                </div>
                <script>
                    document.getElementById('partielle').addEventListener('change', (function() {
                        document.getElementById('submit_all_js').innerHTML = ''
                        document.getElementById('tab_article').style.display = 'block';
                    }));
                    document.getElementById('complete').addEventListener('change', (function() {
                        document.getElementById('submit_all_js').innerHTML =
                            '<input class="btn btn-dark col-lg-2 offset-5" type="submit" value="Soumettre">'
                        document.getElementById('tab_article').style.display = 'none';
                    }));
                </script>
            </form>
        </div>
    </div>
@endsection
