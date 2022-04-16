<?php $__env->startSection('titre'); ?>
    Gestion ENA
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenu'); ?>
    <h1>Inventaire courant</h1>
    <table class="table table-success table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Quantité</th>
                <th>Mouvement</th>
                <th>Désignation</th>
                <th>Marque</th>
                <th>Type</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = App\Models\Stock::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $stock->articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($article->id); ?></td>
                        <td><?php echo e($article->code); ?></td>
                        <td><?php echo e($article->pivot->quantite_article); ?></td>
                        <td><?php echo e($article->pivot->mouvement); ?></td>
                        <td><?php echo e($article->designation); ?></td>
                        <td><?php echo e($article->marque->designation); ?></td>
                        <td><?php echo e($article->type->designation); ?></td>
                        <td><a href="<?php echo e(route('stock.show', $stock->id)); ?>"><?php echo e($stock->nature); ?></a></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <h2>Les commandes en attente de livraison</h2>
    <?php if(App\Models\Commande::where('statut_liv', '!=', 'Livrée')->count() == 0): ?>
        <h5 style="color: red">Aucune commande en attente de livraison</h5>
    <?php else: ?>
        <table class="table table-success table-stripped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Objet</th>
                    <th>Statut de livraison</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = App\Models\Commande::where('statut_liv', '!=', 'Livrée')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($commande->id); ?></td>
                        <td><?php echo e($commande->num); ?></td>
                        <td><?php echo e($commande->objet); ?></td>
                        <td><?php echo e($commande->statut_liv); ?></td>
                        <td><a href="<?php echo e(route('commande.show', $commande->id)); ?>">Voir</a></td>
                        <td><a href="<?php echo e(route('commande.edit', $commande->id)); ?>">Modifier</a></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/gestion_ena.blade.php ENDPATH**/ ?>