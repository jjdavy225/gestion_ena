<?php $__env->startSection('titre'); ?>
    <?php echo e($commande->num); ?>

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
                    <th>Numéro de la commande</th>
                    <td><?php echo e($commande->num); ?></td>
                </tr>
                <tr>
                    <th>Date de commande</th>
                    <td><?php echo e($commande->date); ?></td>
                </tr>
                <tr>
                    <th>Objet</th>
                    <td><?php echo e($commande->objet); ?></td>
                </tr>
                <tr>
                    <th>Fournisseur</th>
                    <td><?php echo e($commande->fournisseur->sigle); ?></td>
                </tr>
                <tr>
                    <th>Téléphone du fournisseur</th>
                    <td><?php echo e($commande->fournisseur->tel); ?></td>
                </tr>
                <tr>
                    <th>Agent</th>
                    <td><?php echo e($commande->agent->nom); ?> <?php echo e($commande->agent->prenom); ?></td>
                </tr>
                <tr>
                    <th>Statut</th>
                    <td>
                        <?php if($commande->statut_liv == 'C1S'): ?>
                            Non validée
                        <?php elseif($commande->statut_liv == 'C1V'): ?>
                            En attente de livraison
                        <?php elseif($commande->statut_liv == 'C1P'): ?>
                            Partiel
                        <?php elseif($commande->statut_liv == 'C1T'): ?>
                            Totalement livré
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </div>
        <?php if($commande->livraisons()->count() != 0): ?>
            <div>
                <h1>Les livraisons concernées</h1>
                <table class="table table-bordered">
                    <thead>
                        <th>Code de la livraison</th>
                        <th>Stock de destination</th>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $commande->livraisons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $livraison): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($livraison->code); ?> <a href="<?php echo e(route('livraison.show', $livraison->id)); ?>"><i
                                    class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i></a></td>
                                <td><?php echo e($livraison->stock->code); ?> <a href="<?php echo e(route('stock.show', $livraison->stock->id)); ?>"><i
                                    class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i></a></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
    <h4 class="text-center">Les articles commandés</h4>
    <table class="table table-bordered">
        <thead>
            <th>Désignation</th>
            <th>Marque</th>
            <th>Prix unitaire</th>
            <th>Qte commandée</th>
            <th>Qte livrée</th>
            <th>Qte restante</th>
        </thead>
        <tbody>
            <?php $__currentLoopData = $commande->articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($article->designation); ?></td>
                    <td><?php echo e($article->marque->designation); ?></td>
                    <td><?php echo e($article->pivot->prix_unitaire); ?></td>
                    <td><?php echo e($article->pivot->quantite); ?></td>
                    <td><?php echo e($article->pivot->quantite_livree); ?></td>
                    <td><?php echo e($article->pivot->reste); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/commande/show.blade.php ENDPATH**/ ?>