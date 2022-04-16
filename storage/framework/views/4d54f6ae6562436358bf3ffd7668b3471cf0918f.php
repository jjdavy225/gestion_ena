<?php $__env->startSection('titre'); ?>
    Inventaire
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenu'); ?>
    <?php if(Session::has('info')): ?>
        <div class="alert alert-primary">
            <?php echo e(Session::get('info')); ?>

        </div>
    <?php endif; ?>
    <h1>Liste des inventaires</h1>
    <div class="container">
        <table class="table table-success table-stripped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Jour et heure</th>
                    <th>Nature</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $inventaires; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inventaire): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($inventaire->id); ?></td>
                        <td><?php echo e($inventaire->code); ?></td>
                        <td><?php echo e($inventaire->created_at); ?></td>
                        <td><?php echo e($inventaire->nature); ?></td>
                        <td><a href="<?php echo e(route('inventaire.show', $inventaire->id)); ?>">Voir</a></td>
                        <td><a href="<?php echo e(route('inventaire.edit', $inventaire->id)); ?>">Modifier</a></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/inventaire/index.blade.php ENDPATH**/ ?>