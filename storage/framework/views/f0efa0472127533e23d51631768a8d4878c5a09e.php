<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php echo $__env->yieldContent('css1'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('favicon-32x32.png')); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('favicon-16x16.png')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/primary.css')); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('titre'); ?></title>
</head>

<body>
    <div class="sidebar">
        <div class="logo">
            <a href="<?php echo e(route('welcome')); ?>">
                <img src="<?php echo e(asset('images/logo_ena.png')); ?>" alt="Logo de l'ENA">
                <div>GESTION ENA</div>
            </a>
        </div>
        <div class="navbar-nav bg-gradient-success accordion" id="menu">
            
            <a class="nav-link" href="<?php echo e(route('commande.index')); ?>">Commandes</a>
            <a class="nav-link" href="<?php echo e(route('article.index')); ?>">Articles</a>
            <a class="nav-link" href="<?php echo e(route('fournisseur.index')); ?>">Fournisseurs</a>
            <a class="nav-link" href="<?php echo e(route('type_article.index')); ?>">Types d'articles</a>
            <a class="nav-link" href="<?php echo e(route('marque_article.index')); ?>">Marques des articles</a>
            <a class="nav-link" href="<?php echo e(route('livraison.index')); ?>">Livraisons</a>
            <a class="nav-link" href="<?php echo e(route('stock.index')); ?>">Stocks</a>
            <a class="nav-link" href="<?php echo e(route('inventaire.index')); ?>">Inventaires</a>
            <a class="nav-link" href="<?php echo e(route('demande.index')); ?>">Demandes</a>
            
            <a class="nav-link" href="<?php echo e(route('sortie.index')); ?>">Sorties</a>
            <a class="nav-link" href="<?php echo e(route('site.index')); ?>">Sites</a>
            <a class="nav-link" href="<?php echo e(route('bureau.index')); ?>">Bureaux</a>
            <a class="nav-link" href="<?php echo e(route('patrimoine.index')); ?>">Patrimoine</a>
            <a class="nav-link" href="<?php echo e(route('retour.index')); ?>">Retour</a>
            <a class="nav-link" href="<?php echo e(route('mouvement.index')); ?>">Mouvement</a>
            
        </div>
    </div>

    <div class="main">
        <header>
            <div class="back">
                <a href="javascript:history.back()" title="Retour"><i class="fa-solid fa-angles-left"></i></a>
            </div>
            <div class="header_div">
                <?php if(auth()->guard()->check()): ?>
                    <?php if(Auth::user()->role_id != null): ?>
                        <div class="account">
                            <?php echo e(Auth::user()->role->designation); ?>

                        </div>
                    <?php endif; ?>
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="<?php echo e(asset('images/user.png')); ?>" height="40px">
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li class="text-center"><?php echo e(Auth::user()->agent->nom); ?> <?php echo e(Auth::user()->agent->prenom); ?>

                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin')): ?>
                                <li><a class="dropdown-item" href="<?php echo e(route('dashboard')); ?>">Tableau de bord</a></li>
                            <?php endif; ?>
                            <li>
                                <form action="<?php echo e(route('logout')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <button class="dropdown-item" type="submit"><i
                                            class="fa-solid fa-right-from-bracket"></i>
                                        Déconnexion</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                <?php else: ?>
                    <div class="registration">
                        <a href="<?php echo e(route('login')); ?>">Connexion</a>
                        <a href="<?php echo e(route('register')); ?>">S'enregistrer</a>
                    </div>
                <?php endif; ?>
            </div>
        </header>
        <aside>
            <section>
                <?php echo $__env->yieldContent('contenu'); ?>
            </section>

            <footer>
                <div>
                    Copyrights &copy ENA 2022 | Tous droits réservés
                </div>
            </footer>
        </aside>
    </div>

    <?php echo $__env->make('sweetalert::alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <script src="<?php echo e(asset('js/eventConfirm.js')); ?>"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js" defer></script>
    <script src="<?php echo e(asset('js/datatables.js')); ?>"></script>
</body>

</html>
<?php /**PATH /home/davy/gestion_ena_backup/resources/views/template/primary.blade.php ENDPATH**/ ?>