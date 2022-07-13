<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('css1')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="stylesheet" href="{{ asset('css/primary.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}">{{-- Font awesome --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
        <div class="navbar-nav bg-gradient-success accordion" id="menu">
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
            <div class="back">
                <a href="javascript:history.back()" title="Retour"><i class="fa-solid fa-angles-left"></i></a>
            </div>
            <div class="header_div">
                @auth
                    @if (Auth::user()->role_id != null)
                        <div class="account">
                            {{ Auth::user()->role->designation }}
                        </div>
                    @endif
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="{{ asset('images/user.png') }}" height="40px">
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li class="text-center">{{ Auth::user()->agent->nom }} {{ Auth::user()->agent->prenom }}
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            @can('admin')
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Tableau de bord</a></li>
                            @endcan
                            <li>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button class="dropdown-item" type="submit"><i
                                            class="fa-solid fa-right-from-bracket"></i>
                                        Déconnexion</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <div class="registration">
                        <a href="{{ route('login') }}">Connexion</a>
                        <a href="{{ route('register') }}">S'enregistrer</a>
                    </div>
                @endauth
            </div>
        </header>
        <aside>
            <section>
                @yield('contenu')
            </section>

            <footer>
                <div>
                    Copyrights &copy ENA 2022 | Tous droits réservés
                </div>
            </footer>
        </aside>
    </div>

    @include('sweetalert::alert')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/eventConfirm.js') }}"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js" defer></script>
    <script src="{{ asset('js/datatables.js') }}"></script>
</body>

</html>
