<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('css1')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}">{{-- Font awesome --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('titre')</title>
</head>

<body>
    <header>
        <div>
            <a href="{{ route('welcome') }}">GESTION ENA</a>
            <div class="user">
                @auth
                    <i class="fa fa-user white"></i>
                    <span>{{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <input class="btn" type="submit" value="Log out">
                    </form>
                @else
                    <a href="{{ route('login') }}">Connexion</a>
                @endauth
            </div>
        </div>
    </header>
    <div class="main">
        <div class="navbar-nav col-lg-2" id="menu">
            <a class="nav-link" href="{{ route('commande.index') }}">Commandes</a>
            <a class="nav-link" href="{{ route('article.index') }}">Articles</a>
            <a class="nav-link" href="{{ route('fournisseur.index') }}">Fournisseurs</a>
            <a class="nav-link" href="{{ route('type_article.index') }}">Types d'articles</a>
            <a class="nav-link" href="{{ route('marque_article.index') }}">Marques des articles</a>
            <a class="nav-link" href="{{ route('livraison.index') }}">Livraisons</a>
            <a class="nav-link" href="{{ route('stock.index') }}">Stocks</a>
            <a class="nav-link" href="{{ route('inventaire.index') }}">Inventaires</a>
            <a class="nav-link" href="{{ route('demande.index') }}">Demandes</a>
            <a class="nav-link" href="{{ route('sortie.index') }}">Sorties</a>
            <a class="nav-link" href="{{ route('site.index') }}">Sites</a>
            <a class="nav-link" href="{{ route('bureau.index') }}">Bureaux</a>
            <a class="nav-link" href="{{ route('patrimoine.index') }}">Patrimoine</a>
            <a class="nav-link" href="{{ route('retour.index') }}">Retour</a>
            <a class="nav-link" href="{{ route('mouvement.index') }}">Mouvement</a>
        </div>

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
</body>

</html>
