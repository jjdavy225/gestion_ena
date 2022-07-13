@extends('template.primary')

@section('titre')
    Sortie
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
@endsection

@section('contenu')
    @if (Session::has('errors_qte'))
        <div class="alert alert-danger">
            {{ Session::get('errors_qte') }}
        </div>
    @endif
    <div class="container-fluid">
        <div class="container">
            <form action="{{ route('sortie.store') }}" method="post">
                @csrf

                <div class="container mt-3">
                    <h3 class="text-center">Renseignez la sortie</h3>
                </div>

                <div class="container" id="conteneur_type">
                    <h5 class="text-center">Choisissez le type de sortie</h5>
                    <div id="type_liv">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type_sortie" value="complete" id="complete">
                            <label class="form-check-label" for="complete">complète (tous les articles demandés)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type_sortie" value="partielle"
                                id="partielle">
                            <label class="form-check-label" for="partielle">partielle</label>
                        </div>
                    </div>
                </div>

                <div class="row border rounded-5 p-4 mb-4 mt-4 shadow">
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="date">Date de sortie</label>
                            <input required class="form-control" type="date" name="date" id="date"
                                value="{{ old('date') }}">
                            @error('date')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="nature">Nature de la sortie</label>
                            <input required class="form-control" type="text" name="nature" id="nature"
                                value="{{ old('nature') }}">
                            @error('nature')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="demande">Demande</label>
                            <select class="form-select" name="demande" id="demande">
                                <script>
                                    let demandes = {};
                                </script>
                                <option disabled selected>Choisissez une demande</option>
                                @foreach ($demandes as $demande)
                                    @if (($demande->statut == 'D1V') || ($demande->statut == 'D1P'))
                                        <option value="{{ $demande->id }}">Code : {{ $demande->code }} |Objet :
                                            {{ $demande->objet }}</option>
                                        <script>
                                            demandes['{{ $demande->id }}'] = {};
                                        </script>
                                        @foreach ($demande->articles as $article)
                                            <script>
                                                demandes['{{ $demande->id }}']['{{ $article->designation }} {{ $article->marque->designation }}'] = [
                                                    '{{ $article->id }}',
                                                    '{{ $article->pivot->reste }}'
                                                ]
                                            </script>
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                            @error('demande')
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
                                    const doc = document.getElementById('demande');
                                    const doc2 = document.getElementById('tab_choix_js');
                                    tab_choix(demandes[doc.value], doc2);
                                    doc.addEventListener('change', (function() {
                                        var articles_c = demandes[doc.value];
                                        tab_choix(articles_c, doc2);
                                    }))

                                    function tab_choix(articles, tab) {
                                        tab.innerHTML = ""
                                        for (var designation in articles) {
                                            var id = articles[designation][0]
                                            var reste = articles[designation][1]
                                            if (reste > 0) {
                                                tab.innerHTML += '<tr><td>' + designation +
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
                            var articles_c = demandes[doc.value];
                            texte.innerHTML = '<h5 class = "text-center mt-2">Entrer les quantités livrées</h5>'
                            for (let designation in articles_c) {
                                var reste = articles_c[designation][1];
                                if (reste > 0) {
                                    if (document.getElementById(designation).checked == true) {
                                        a = true;
                                        texte.innerHTML +=
                                            '<div class="form-group mb-3 col-lg-6" style="margin-left:auto;margin-right:auto;"><label class="form-label">' +
                                            designation +
                                            '</label><input class="form-control" type="number" name="qtes[]" placeholder="Restant : ' +
                                            reste + '" required min="0" max="' +
                                            reste + '"></div>'
                                        document.getElementById('submit_all_js').innerHTML =
                                            '<input class="btn btn-danger col-lg-2 offset-5" type="submit" value="Soumettre">'
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
                            '<input class="btn btn-danger col-lg-2 offset-5" type="submit" value="Soumettre">'
                        document.getElementById('tab_article').style.display = 'none';
                    }));
                </script>
            </form>
        </div>
    </div>
@endsection
