<?php $__env->startSection('contenu'); ?>
    <h1>Infos</h1>
    <ul>
        <li>Code de l'article : <?php echo e($article->code); ?></li>
        <li>Désignation : <?php echo e($article->designation); ?></li>
        <li>Marque : <?php echo e($article->marque['designation']); ?></li>
        <li>Type : <?php echo e($article->type['designation']); ?></li>
    </ul>
    <button><a href="<?php echo e(route('article.index')); ?>">Retour</a></button>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena/resources/views/article/show.blade.php ENDPATH**/ ?>