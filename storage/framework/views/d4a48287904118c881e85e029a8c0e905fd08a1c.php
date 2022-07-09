<?php $__env->startSection('titre'); ?>
    <?php echo e($livraison->code); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css1'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/style1.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenu'); ?>
    <div class="tableShowContainer">
        <div>
            <h1>Infos</h1>
            <table class="table table-bordered">
                <tr>
                    <th>Code de la livraison</th>
                    <td><?php echo e($livraison->code); ?></td>
                </tr>
                <tr>
                    <th>Date de la livraison</th>
                    <td><?php echo e($livraison->date); ?></td>
                </tr>
                <tr>
                    <th>Commande concernée</th>
                    <td><?php echo e($livraison->commande->num); ?> <a
                            href="<?php echo e(route('commande.show', $livraison->commande->id)); ?>"><i
                                class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i></a></td>
                </tr>
                <tr>
                    <th>Stock de destination</th>
                    <td><?php echo e($livraison->stock->code); ?> <a href="<?php echo e(route('stock.show', $livraison->stock->id)); ?>"><i
                                class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i></a></td>
                </tr>
                <tr>
                    <th>Fournisseur</th>
                    <td><?php echo e($livraison->commande->fournisseur->sigle); ?></td>
                </tr>
                <tr>
                    <th>Agent</th>
                    <td><?php echo e($livraison->agent->nom); ?> <?php echo e($livraison->agent->prenom); ?></td>
                </tr>
                <tr>
                    <th>Statut</th>
                    <td>
                        <?php if($livraison->statut == 'L1S'): ?>
                            Non validée
                        <?php elseif($livraison->statut == 'L1V'): ?>
                            Livraison validée
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <h4 class="text-center">Les articles livrés</h4>
    <table class="table table-bordered">
        <thead>
            <th>Désignation</th>
            <th>Marque</th>
            <th>Qte livrée</th>
            <th>Qte restante</th>
            <th>Pprix unitaire</th>
        </thead>
        <tbody>
            <?php $__currentLoopData = $livraison->articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($article->designation); ?></td>
                    <td><?php echo e($article->marque->designation); ?></td>
                    <td><?php echo e($article->pivot->quantite_livree); ?></td>
                    <td><?php echo e($article->pivot->reste); ?></td>
                    <td><?php echo e($article->pivot->prix_unitaire); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/livraison/show.blade.php ENDPATH**/ ?>