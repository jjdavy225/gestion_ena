<?php $__env->startSection('titre'); ?>
    Liste des demandes
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
    <h1>Liste des demandes</h1>
    <div class="container">
        <table class="table table-success table-stripped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Objet</th>
                    <th>Statut</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $demandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($demande->id); ?></td>
                        <td><?php echo e($demande->code); ?></td>
                        <td><?php echo e($demande->objet); ?></td>
                        <td><?php echo e($demande->statut); ?></td>
                        <td><a href="<?php echo e(route('demande.show', $demande->id)); ?>">Voir</a></td>
                        <td><a href="<?php echo e(route('demande.edit', $demande->id)); ?>">Modifier</a></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <h4>Enregistrer une nouvelle demande <a href="<?php echo e(route('demande.create')); ?>">ici!</a></h4>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/demande/index.blade.php ENDPATH**/ ?>