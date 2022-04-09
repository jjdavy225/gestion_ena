<?php $__env->startSection('titre'); ?>
    Fournisseurs
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenu'); ?>
    <h1>Liste des fournisseurs</h1>
    <table class="table table-success table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Sigle</th>
                <th>Siège</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $fournisseurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fournisseur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($fournisseur->id); ?></td>
                    <td><?php echo e($fournisseur->code); ?></td>
                    <td><?php echo e($fournisseur->sigle); ?></td>
                    <td><?php echo e($fournisseur->siege); ?></td>
                    <td><a href="<?php echo e(route('fournisseur.show', $fournisseur->id)); ?>">Voir</a></td>
                    <td><a href="<?php echo e(route('fournisseur.edit', $fournisseur->id)); ?>">Modifier</a></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <h4>Enregistrer un nouveau fournisseur <a href="<?php echo e(route('fournisseur.create')); ?>">ici!</a></h4>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/fournisseur/index.blade.php ENDPATH**/ ?>