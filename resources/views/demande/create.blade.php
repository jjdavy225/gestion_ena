@extends('template.primary')

@section('titre')
    Nouvelle demande
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
            <form action="{{ route('demande.store') }}" method="post">
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
                                @foreach ($stocks as $stock)
                                    @foreach ($stock->articles as $article)
                                        @if ($article->pivot->quantite_totale > 0)
                                            <tr>
                                                <td>{{ $article->designation }}</td>
                                                <td>{{ $article->marque->designation }}</td>
                                                <td><input class="checkbox styled checkbox-primary"
                                                        id="{{ $article->code }}" type="checkbox" name="articles[]"
                                                        value="{{ $article->id }}"
                                                        {{ in_array($article->id, old('articles') ?: []) ? 'checked' : '' }}>
                                                </td>
                                                <script type="text/javascript">
                                                    articles['{{ $article->code }}'] = ['{{ $article->designation }} {{ $article->marque->designation }}',
                                                        '{{ $article->pivot->quantite_totale }}'
                                                    ];
                                                </script>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="boutons">
                        <button type="button" id="activ_js">Ok</button>
                    </div>

                    <div id="liste_article"></div>

                    <script type="text/javascript">
                        const texte = document.getElementById('liste_article');
                        document.getElementById('activ_js').addEventListener("click", (function() {
                            let a = false;
                            texte.innerHTML = '<h5 class = "text-center mt-2">Entrer les quantités</h5>'
                            for (let article in articles) {
                                if (document.getElementById(article).checked == true) {
                                    a = true;
                                    texte.innerHTML +=
                                        '<div class="form-group mb-3 col-lg-6 mx-auto"><label class="form-label">' + articles[
                                            article][0] + ' | En stock : ' + articles[article][1] +
                                        '</label><input class="form-control" type="number" name="qtes[]" placeholder="Quantité" required min="0" max="' +
                                        articles[article][1] + '"></div>'

                                }
                            }
                            if (!a) {
                                texte.innerHTML =
                                    '<h5 class="text-center" style="color:red;">CHOISSSEZ AU MOINS UN ARTICLE</h5>';
                                document.getElementById('submit_all_js').innerHTML = '';
                            } else {
                                document.getElementById('submit_all_js').innerHTML =
                                    '<input class="btn btn-dark col-lg-2 offset-5 shadow-sm" type="submit" value="Valider">'
                            }
                        }))
                    </script>
                </div>

                <div class="container mt-3">
                    <h3 class="text-center">Renseignez votre demande</h3>
                </div>

                <div class="row border rounded-5 p-4 mb-4 mt-4 shadow">
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="date">Date de la demande</label>
                            <input required class="form-control" type="date" name="date" id="date"
                                value="{{ old('date') }}">
                            @error('date')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="objet">Objet de la demande</label>
                            <input required class="form-control" type="text" name="objet" id="objet"
                                value="{{ old('objet') }}">
                            @error('objet')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="fiche">Fiche</label>
                            <input required class="form-control" type="text" name="fiche" id="fiche"
                                value="{{ old('fiche') }}">
                            @error('fiche')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="delai">Delai</label>
                            <input required class="form-control" type="number" min="0" name="delai" id="delai"
                                value="{{ old('delai') }}">
                            @error('delai')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="code_secteur">Code secteur</label>
                            <input required class="form-control" type="text" name="code_secteur" id="code_secteur"
                                value="{{ old('code_secteur') }}">
                            @error('code_secteur')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="bureau">Bureau</label>
                            <select class="form-select" name="bureau" id="bureau">
                                <option disabled selected>Choisissez un bureau</option>
                                @foreach ($bureaux as $bureau)
                                    <option value="{{ $bureau->id }}">
                                        {{ $bureau->site->designation }}-{{ $bureau->designation }}</option>
                                @endforeach
                            </select>
                            @error('bureau')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div id="submit_all_js"></div>
            </form>
        </div>
    @endsection
