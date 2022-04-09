<?php $__env->startSection('titre'); ?>
    Liste des livraisons
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
    <h1>Liste des livraisons</h1>
    <div class="container">
        <table class="table table-success table-stripped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Date de livraison</th>
                    <th>Commande concernée</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $livraisons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $livraison): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($livraison->id); ?></td>
                        <td><?php echo e($livraison->code); ?></td>
                        <td><?php echo e($livraison->date); ?></td>
                        <td><a href="<?php echo e(route('commande.show', $livraison->commande->id)); ?>"><?php echo e($livraison->commande->num); ?></a></td>
                        <td><a href="<?php echo e(route('livraison.show', $livraison->id)); ?>">Voir</a></td>
                        <td><a href="<?php echo e(route('livraison.edit', $livraison->id)); ?>">Modifier</a></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <h4>Enregistrer une nouvelle livraison <a href="<?php echo e(route('livraison.create')); ?>">ici!</a></h4>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/livraison/index.blade.php ENDPATH**/ ?>