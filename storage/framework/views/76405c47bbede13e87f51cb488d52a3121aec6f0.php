<?php $__env->startSection('titre'); ?>
    Liste des commandes
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css1'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/style1.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenu'); ?>
    <?php if(Session::has('info')): ?>
        <div class="alert alert-primary">
            <?php echo e(Session::get('info')); ?>

        </div>
    <?php endif; ?>
    <h1>Liste des commandes</h1>
    <div class="container">
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
                <?php $__currentLoopData = $commandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
    </div>
    <h4>Enregistrer une nouvelle commande <a href="<?php echo e(route('commande.create')); ?>">ici!</a></h4>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/commande/index.blade.php ENDPATH**/ ?>