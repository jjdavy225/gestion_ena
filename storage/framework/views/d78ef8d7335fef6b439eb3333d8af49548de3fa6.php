<?php $__env->startSection('titre'); ?>
    Types d'articles
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenu'); ?>
    <?php if(Session::has('info')): ?>
        <div class="alert alert-primary">
            <?php echo e(Session::get('info')); ?>

        </div>
    <?php endif; ?>
    <h1>Liste des types des articles</h1>
    <table class="table table-success table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($type->id); ?></td>
                    <td><?php echo e($type->code); ?></td>
                    <td><?php echo e($type->designation); ?></td>
                    <td><a href="<?php echo e(route('type_article.edit', $type->id)); ?>">Modifier</a></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <h4>Enregistrer un nouveau type <a href="<?php echo e(route('type_article.create')); ?>">ici!</a></h4>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena/resources/views/type_article/index.blade.php ENDPATH**/ ?>