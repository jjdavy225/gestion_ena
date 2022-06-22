<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php echo $__env->yieldContent('css1'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/primary.css')); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
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
        <div class="navbar-nav" id="menu">
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
            <div class="user">
                <?php if(auth()->guard()->check()): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin')): ?>
                        <a href="<?php echo e(route('dashboard')); ?>">Tableau de bord</a>
                    <?php endif; ?>
                    <i class="fa fa-user white"></i>
                    <span><?php echo e(Auth::user()->agent->nom); ?> <?php if(Auth::user()->role_id != null): ?>| <?php echo e(Auth::user()->role->designation); ?><?php endif; ?></span>
                    <form action="<?php echo e(route('logout')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <input class="btn" type="submit" value="Log out">
                    </form>
                <?php else: ?>
                    <a style="margin-right: 20px" href="<?php echo e(route('login')); ?>">Connexion</a>
                    <a href="<?php echo e(route('register')); ?>">S'enregistrer</a>
                <?php endif; ?>
            </div>
        </header>
        <aside>
            <section>
                <?php echo $__env->yieldContent('contenu'); ?>
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
<?php /**PATH /home/davy/gestion_ena_backup/resources/views/template/primary.blade.php ENDPATH**/ ?>