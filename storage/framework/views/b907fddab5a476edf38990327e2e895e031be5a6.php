<?php $__env->startSection('titre'); ?>
    <?php echo e($commande->num); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css1'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/style1.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenu'); ?>
    <h1>Infos</h1>
    <ul class="show">
        <li>Numéro de la commande : <?php echo e($commande->num); ?></li>
        <li>Date de commande : <?php echo e($commande->date); ?></li>
        <li>Objet : <?php echo e($commande->objet); ?></li>
        <li>Fournisseur : <?php echo e($commande->fournisseur->sigle); ?></li>
        <li>Tel fournisseur : <?php echo e($commande->fournisseur->tel); ?></li>
        <li>Statut de livraison : <?php echo e($commande->statut_liv); ?>

            <?php if($commande->statut_liv != 'Non livrée'): ?>
                <span> | Nombre de livraisons éffectuées : <?php echo e(count($commande->livraisons)); ?></span>
                <ul>Les livraisons concernées
                    <?php $__currentLoopData = $commande->livraisons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $livraison): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="<?php echo e(route('livraison.show', $livraison->id)); ?>"><?php echo e($livraison->code); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php endif; ?>
        </li>
        <li>Les articles commandés
            <ul>
                <?php $__currentLoopData = $commande->articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($article->designation); ?> | <?php echo e($article->marque->designation); ?>

                        <ul>
                            <li>Quantité commandée : <?php echo e($article->pivot->quantite); ?></li>
                            <li>Quantité livrée : <?php echo e($article->pivot->quantite_livree); ?></li>
                            <li>Quantité restante : <?php echo e($article->pivot->reste); ?></li>
                        </ul>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </li>
        <li>Agent : <?php echo e($commande->agent->nom); ?> <?php echo e($commande->agent->prenom); ?></li>
    </ul>
    <button><a href="<?php echo e(route('commande.index')); ?>">Retour</a></button>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/commande/show.blade.php ENDPATH**/ ?>