<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('css1')
    <link rel="stylesheet" href="{{ asset('css/primary.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}">{{-- Font awesome --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('titre')</title>
</head>

<body>
    <div class="sidebar">
        <div class="logo">
            <a href="{{ route('welcome') }}">
                <img src="{{ asset('images/logo_ena.png') }}" alt="Logo de l'ENA">
                <div>GESTION ENA</div>
            </a>
        </div>
        <div class="navbar-nav" id="menu">
            {{-- <a href="#gestionStock" class="nav-link" role="button" data-bs-toggle="collapse" aria-expanded="false"
                aria-controls="gestionStock">Gestion du stock</a>
            <div class="collapse" id="gestionStock">
                <div class="card card-body"> --}}
            <a class="nav-link" href="{{ route('commande.index') }}">Commandes</a>
            <a class="nav-link" href="{{ route('article.index') }}">Articles</a>
            <a class="nav-link" href="{{ route('fournisseur.index') }}">Fournisseurs</a>
            <a class="nav-link" href="{{ route('type_article.index') }}">Types d'articles</a>
            <a class="nav-link" href="{{ route('marque_article.index') }}">Marques des articles</a>
            <a class="nav-link" href="{{ route('livraison.index') }}">Livraisons</a>
            <a class="nav-link" href="{{ route('stock.index') }}">Stocks</a>
            <a class="nav-link" href="{{ route('inventaire.index') }}">Inventaires</a>
            <a class="nav-link" href="{{ route('demande.index') }}">Demandes</a>
            {{-- </div>
            </div>
            <a href="#gestionPatrimoine" class="nav-link" role="button" data-bs-toggle="collapse" aria-expanded="false"
                aria-controls="gestionPatrimoine">Gestion du patrimoine</a>
            <div class="collapse" id="gestionPatrimoine">
                <div class="card card-body"> --}}
            <a class="nav-link" href="{{ route('sortie.index') }}">Sorties</a>
            <a class="nav-link" href="{{ route('site.index') }}">Sites</a>
            <a class="nav-link" href="{{ route('bureau.index') }}">Bureaux</a>
            <a class="nav-link" href="{{ route('patrimoine.index') }}">Patrimoine</a>
            <a class="nav-link" href="{{ route('retour.index') }}">Retour</a>
            <a class="nav-link" href="{{ route('mouvement.index') }}">Mouvement</a>
            {{-- </div>
            </div>
            <a href="#gestionParcAuto" class="nav-link" role="button" data-bs-toggle="collapse" aria-expanded="false"
                aria-controls="gestionParcAuto">Gestion du parc auto</a>
            <div class="collapse" id="gestionParcAuto">
                <div class="card card-body">
                    Aucun module !!
                </div>
            </div> --}}
        </div>
    </div>

    <div class="main">
        <header>
            <div class="user">
                @auth
                    @can('admin')
                        <a href="{{ route('dashboard') }}">Tableau de bord</a>
                    @endcan
                    <i class="fa fa-user white"></i>
                    <span>{{ Auth::user()->agent->nom }} @if (Auth::user()->role_id != null)
                            | {{ Auth::user()->role->designation }}
                        @endif
                    </span>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn btn-dark mx-3" type="submit"><i class="fa-solid fa-right-from-bracket"></i>
                            Déconnexion</button>
                    </form>
                @else
                    <a style="margin-right: 20px" href="{{ route('login') }}">Connexion</a>
                    <a href="{{ route('register') }}">S'enregistrer</a>
                @endauth
            </div>
        </header>
        <aside>
            <section>
                @yield('contenu')
            </section>
        </aside>
        <footer>
            <div>
                Copyrights &copy ENA 2022 | Tous droits réservés
            </div>
        </footer>
    </div>
</body>

</html>
