<?php $__env->startSection('titre'); ?>
    Inventaire
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenu'); ?>
    <?php if(Session::has('info')): ?>
        <div class="alert alert-primary">
            <?php echo e(Session::get('info')); ?>

        </div>
    <?php endif; ?>
    <h2 style="color: red;text-align : center;margin-top :10%">Page index en développement...</h2>
    <h3 style="text-align: center">Faites l'inventaire <a href="<?php echo e(route('inventaire.create')); ?>">ici</a></h3>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/inventaire/index.blade.php ENDPATH**/ ?>