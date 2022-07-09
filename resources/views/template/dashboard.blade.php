<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('css1')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
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
    {{-- <div class="sidebar">
        <div class="navbar-nav" id="menu">
            <a class="nav-link" href="#">Liste des utilisateurs</a>
            <a class="nav-link" href="#">Attribuer un rôle</a>
        </div>
    </div> --}}

    <header>
        <div class="logo">
            <a href="{{ route('welcome') }}">
                <img src="{{ asset('images/logo_ena.png') }}" alt="Logo de l'ENA">
                <div>GESTION ENA</div>
            </a>
        </div>
        <div class="user">
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
                        <li class="text-center">{{ Auth::user()->agent->nom }} {{ Auth::user()->agent->prenom }}</li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        @can('admin')
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}">Tableau de bord</a></li>
                        @endcan
                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="dropdown-item" type="submit"><i class="fa-solid fa-right-from-bracket"></i>
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
</body>

</html>
