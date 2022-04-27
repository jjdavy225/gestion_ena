<?php $__env->startSection('titre'); ?>
    <?php echo e($demande->code); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css1'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/style1.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenu'); ?>
    <h1>Infos</h1>
    <ul class="show">
        <li>Numéro de la demande : <?php echo e($demande->code); ?></li>
        <li>Date de demande : <?php echo e($demande->date); ?></li>
        <li>Objet : <?php echo e($demande->objet); ?></li>
        <li>Fiche : <?php echo e($demande->fiche); ?></li>
        <li>Delai : <?php echo e($demande->delai); ?></li>
        <li>Statut de sortie : <?php echo e($demande->statut); ?></li>
        <li>Code secteur : <?php echo e($demande->code_secteur); ?></li>
        <li>Code propriétaire : <?php echo e($demande->code_proprietaire); ?></li>
        <li>Les articles demandés
            <ul>
                <?php $__currentLoopData = $demande->articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($article->designation); ?> | <?php echo e($article->marque->designation); ?>

                        <ul>
                            <li>Quantité demandée : <?php echo e($article->pivot->quantite); ?></li>
                            <li>Quantité sortie : <?php echo e($article->pivot->quantite_sortie); ?></li>
                            <li>Reste : <?php echo e($article->pivot->reste); ?></li>
                        </ul>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </li>
        <li>Agent : <?php echo e($demande->agent->nom); ?> <?php echo e($demande->agent->prenom); ?></li>
    </ul>
    <button><a href="<?php echo e(route('demande.index')); ?>">Retour</a></button>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/demande/show.blade.php ENDPATH**/ ?>