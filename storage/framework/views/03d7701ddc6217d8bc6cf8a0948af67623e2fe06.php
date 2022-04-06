<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo $__env->yieldContent('css1'); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $__env->yieldContent('titre'); ?></title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?php echo e(route('welcome')); ?>">GESTION ENA</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" href="<?php echo e(route('commande.index')); ?>">Commandes</a>
                        <a class="nav-link" href="<?php echo e(route('article.index')); ?>">Articles</a>
                        <a class="nav-link" href="<?php echo e(route('fournisseur.index')); ?>">Fournisseurs</a>
                        <a class="nav-link" href="<?php echo e(route('type_article.index')); ?>">Types d'articles</a>
                        <a class="nav-link" href="<?php echo e(route('marque_article.index')); ?>">Marques des articles</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <?php echo $__env->yieldContent('contenu'); ?>
</body>

</html>
<?php /**PATH /home/davy/gestion_ena/resources/views/commande/template.blade.php ENDPATH**/ ?>