<?php $__env->startSection('titre'); ?>
    Liste des articles
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenu'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['agent', 'responsable'])): ?>
        <div class="linksContainer">
            <a class="buttonLinks" title="Nouvel article" href="<?php echo e(route('article.create')); ?>"><i
                    class="fa-solid fa-plus"></i></a>
        </div>
    <?php endif; ?>
    <h1>Liste des articles</h1>
    <table class="table table-success table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Désignation</th>
                <th>Marque</th>
                <th>Type</th>
                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['agent', 'responsable'])): ?>
                    <th></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($article->id); ?></td>
                    <td><?php echo e($article->code); ?></td>
                    <td><?php echo e($article->designation); ?></td>
                    <td><?php echo e($article->marque->designation); ?></td>
                    <td><?php echo e($article->type->designation); ?></td>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['agent', 'responsable'])): ?>
                        <td class="tabButtonContainer">
                            <a class="buttonLinksTab btn-success" href="<?php echo e(route('article.edit', $article->id)); ?>"><i
                                    class="fa-solid fa-file-pen"></i></a>
                            <form class="delete" onsubmit="return confirm('Do you really want to submit the form ?');"
                                action="<?php echo e(route('article.destroy', $article->id)); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="buttonLinksTab btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                            </form>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/article/index.blade.php ENDPATH**/ ?>