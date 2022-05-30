@extends('template.primary')

@section('titre')
    Retour
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
            <form action="{{ route('retour.store') }}" method="post">
                @csrf

                <div class="container mt-3">
                    <h3 class="text-center">Renseignez le retour</h3>
                </div>


                <div class="row border rounded-5 p-4 mb-4 mt-4 shadow">
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="date">Date du retour</label>
                            <input required class="form-control" type="date" name="date" id="date"
                                value="{{ old('date') }}">
                            @error('date')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="obs">Observation</label>
                            <input required class="form-control" type="text" name="obs" id="obs"
                                value="{{ old('obs') }}">
                            @error('obs')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="stock">Stock</label>
                            <select required class="form-select" name="stock" id="stock">
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
                            <label class="form-label" for="bureau">Bureau</label>
                            <select required class="form-select" name="bureau" id="bureau">
                                <script>
                                    let patrimoines = {};
                                </script>
                                <option disabled selected>Choisissez un bureau</option>
                                @foreach ($bureaux as $bureau_id)
                                    @php
                                        $bureau = App\Models\Bureau::find($bureau_id);
                                    @endphp
                                    <option value="{{ $bureau->id }}">
                                        {{ $bureau->site->designation }}-{{ $bureau->designation }}</option>
                                    <script>
                                        patrimoines['{{ $bureau_id }}'] = {};
                                    </script>
                                    @foreach ($patrimoines->where('bureau_id', '=', $bureau_id) as $patrimoine)
                                        <script>
                                            patrimoines['{{ $bureau_id }}'][
                                                '{{ $patrimoine->article->designation }} {{ $patrimoine->article->marque->designation }}'
                                            ] = [
                                                '{{ $patrimoine->article->id }}',
                                                '{{ $patrimoine->quantite }}'
                                            ]
                                        </script>
                                    @endforeach
                                @endforeach
                            </select>
                            @error('bureau')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3" id="tab_article">
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
                                    const doc = document.getElementById('bureau');
                                    const doc2 = document.getElementById('tab_choix_js');
                                    tab_choix(patrimoines[doc.value], doc2);
                                    doc.addEventListener('change', (function() {
                                        var articles_c = patrimoines[doc.value];
                                        tab_choix(articles_c, doc2);
                                    }))

                                    function tab_choix(articles, tab) {
                                        tab.innerHTML = ""
                                        for (var designation in articles) {
                                            var id = articles[designation][0]
                                            var quantite = articles[designation][1]
                                            if (quantite > 0) {
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
                            var articles_c = patrimoines[doc.value];
                            texte.innerHTML = '<h5 class = "text-center mt-2">Entrer les quantités à retourner</h5>'
                            for (let designation in articles_c) {
                                var quantite = articles_c[designation][1];
                                if (quantite > 0) {
                                    if (document.getElementById(designation).checked == true) {
                                        a = true;
                                        texte.innerHTML +=
                                            '<div class="form-group mb-3 col-lg-6" style="margin-left:auto;margin-right:auto;"><label class="form-label">' +
                                            designation +
                                            '</label><input class="form-control" type="number" name="qtes[]" placeholder="Quantité sur place : ' +
                                            quantite + '" required min="0" max="' +
                                            quantite + '"></div>'
                                        document.getElementById('submit_all_js').innerHTML =
                                            '<input class="btn btn-dark col-lg-2 offset-5" type="submit" value="Soumettre">'
                                    }
                                }
                            }
                            if (!a) {
                                texte.innerHTML =
                                    '<h5 class="text-center" style="color:red;">CHOISSSEZ AU MOINS UN ARTICLE</h5>';
                                document.getElementById('submit_all_js').innerHTML = '';
                            } else {
                                document.getElementById('submit_all_js').innerHTML =
                                    '<input class="btn btn-dark col-lg-2 offset-5" type="submit" value="Soumettre">'
                            }
                        }))
                    </script>
                </div>
                <div id="submit_all_js">
                </div>
                <script></script>
            </form>
        </div>
    </div>
@endsection
