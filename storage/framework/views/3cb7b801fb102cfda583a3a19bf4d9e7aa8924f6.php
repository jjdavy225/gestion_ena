<?php $__env->startSection('titre'); ?>
    Marques des articles
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenu'); ?>
    <?php if(Session::has('info')): ?>
        <div class="alert alert-primary">
            <?php echo e(Session::get('info')); ?>

        </div>
    <?php endif; ?>
    <h1>Liste des marques des articles</h1>
    <table class="table table-success table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Désignation</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $marques; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marque): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($marque->id); ?></td>
                    <td><?php echo e($marque->code); ?></td>
                    <td><?php echo e($marque->designation); ?></td>
                    <td><a href="<?php echo e(route('marque_article.edit', $marque->id)); ?>">Modifier</a></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <h4>Enregistrer une nouvelle marque <a href="<?php echo e(route('marque_article.create')); ?>">ici!</a></h4>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/marque_article/index.blade.php ENDPATH**/ ?>