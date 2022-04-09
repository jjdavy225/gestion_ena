<?php $__env->startSection('titre'); ?>
    <?php echo e($livraison->code); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css1'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/style1.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenu'); ?>
    <h1>Infos</h1>
    <ul class="show">
        <li>Numéro de la livraison : <?php echo e($livraison->code); ?></li>
        <li>Date de livraison : <?php echo e($livraison->date); ?></li>
        <li>Commande concernée : <a href="<?php echo e(route('commande.show',$livraison->commande->id)); ?>"><?php echo e($livraison->commande->num); ?></a></li>
        <li>Fournisseur : <?php echo e($livraison->commande->fournisseur->sigle); ?></li>
        <li>Stock : <a href="<?php echo e(route('stock.show',$livraison->stock->id)); ?>"><?php echo e($livraison->stock->code); ?></a> | <?php echo e($livraison->stock->nature); ?></li>
        <li>Les articles livrés
            <ul>
                <?php $__currentLoopData = $livraison->articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($article->designation); ?> | <?php echo e($article->marque->designation); ?>

                        <ul>
                            <li>Quantité livrée : <?php echo e($article->pivot->quantite_livree); ?></li>
                            <li>Quantité restante : <?php echo e($article->pivot->reste); ?></li>
                            <li>Prix unitaire : <?php echo e($article->pivot->prix_unitaire); ?></li>
                        </ul>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </li>
        <li>Agent : <?php echo e($livraison->agent->nom); ?> <?php echo e($livraison->agent->prenom); ?></li>
    </ul>
    <button><a href="<?php echo e(route('livraison.index')); ?>">Retour</a></button>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/livraison/show.blade.php ENDPATH**/ ?>