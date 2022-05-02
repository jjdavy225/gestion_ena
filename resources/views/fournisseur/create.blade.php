@extends('template.primary')

@section('css1')
    <link rel="stylesheet" href="{{ secure_asset('css/style1.css') }}">
@endsection

@section('titre')
    Nouveau fournisseur
@endsection

@section('contenu')
    <div class="container">
        <form action="{{ route('fournisseur.store') }}" method="post">
            @csrf
            <div class="container mt-3">
                <h3 class="text-center">Renseignez les infos du nouveau fournisseur</h3>
            </div>
            <div class="row border rounded-5 p-4 mb-4 mt-4 shadow">

                <div class="row">

                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="sigle">Sigle</label>
                            <input class="form-control" type="text" name="sigle" id="sigle" value="{{ old('sigle') }}">
                            @error('sigle')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="siege">Siège</label>
                            <input class="form-control" type="text" name="siege" id="siege" value="{{ old('siege') }}">
                            @error('siege')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="adresse">Adresse</label>
                            <input class="form-control" type="text" name="adresse" id="adresse"
                                value="{{ old('adresse') }}">
                            @error('adresse')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="tel">Téléphone</label>
                            <input class="form-control" type="tel" name="tel" id="tel" value="{{ old('tel') }}">
                            @error('tel')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="fax">Fax</label>
                            <input class="form-control" type="tel" name="fax" id="fax" value="{{ old('fax') }}">
                            @error('fax')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" type="email" name="email" id="email"
                                value="{{ old('email') }}">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="site_web">Site WEB</label>
                            <input class="form-control" type="text" name="site_web" id="site_web"
                                value="{{ old('site_web') }}">
                            @error('site_web')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="r_com">R_COM</label>
                            <input class="form-control" type="text" name="r_com" id="r_com" value="{{ old('r_com') }}">
                            @error('r_com')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="ccont">CCONT</label>
                            <input class="form-control" type="text" name="ccont" id="ccont" value="{{ old('ccont') }}">
                            @error('ccont')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="banque">Nom de la banque</label>
                            <input class="form-control" type="text" name="banque" id="banque"
                                value="{{ old('banque') }}">
                            @error('banque')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="compte">Numéro de compte</label>
                            <input class="form-control" type="text" name="compte" id="compte"
                                value="{{ old('compte') }}">
                            @error('compte')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="contact">Contact</label>
                            <input class="form-control" type="text" name="contact" id="contact"
                                value="{{ old('contact') }}">
                            @error('contact')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="activite">Activité</label>
                            <input class="form-control" type="text" name="activite" id="activite"
                                value="{{ old('activite') }}">
                            @error('activite')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="capital">Capital</label>
                            <input class="form-control" type="tel" name="capital" id="capital"
                                value="{{ old('capital') }}">
                            @error('capital')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="regime_impot">Régime impôt</label>
                            <input class="form-control" type="text" name="regime_impot" id="regime_impot"
                                value="{{ old('regime_impot') }}">
                            @error('regime_impot')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="centre_impot">Centre impôt</label>
                            <input class="form-control" type="text" name="centre_impot" id="centre_impot"
                                value="{{ old('centre_impot') }}">
                            @error('centre_impot')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="boutons">
                    <input id="new_article_valider" type="submit" value="Valider">
                </div>

            </div>
        </form>
    </div>
@endsection
