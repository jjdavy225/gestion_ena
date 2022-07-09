<?php $__env->startSection('titre'); ?>
    Inventaire
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenu'); ?>
    <h1>Liste des inventaires</h1>
    <div class="container">
        <table class="table datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Jour et heure</th>
                    <th>Nature</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i = 1
                ?>
                <?php $__currentLoopData = $inventaires; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inventaire): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($i++); ?></td>
                        <td><?php echo e($inventaire->code); ?></td>
                        <td><?php echo e($inventaire->created_at); ?></td>
                        <td><?php echo e($inventaire->nature); ?></td>
                        <td class="tabButtonContainer"><a class="buttonLinksTab btn-primary" href="<?php echo e(route('inventaire.show', $inventaire->id)); ?>"><i class="fa-solid fa-file-lines"></i></a></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/inventaire/index.blade.php ENDPATH**/ ?>