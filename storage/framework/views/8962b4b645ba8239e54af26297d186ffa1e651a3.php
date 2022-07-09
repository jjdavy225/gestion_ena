<?php $__env->startSection('titre'); ?>
    Types d'articles
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenu'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['agent', 'responsable'])): ?>
        <div class="linksContainer">
            <a class="buttonLinks" href="<?php echo e(route('type_article.create')); ?>"><i class="fa-solid fa-plus"></i></a>
        </div>
    <?php endif; ?>
    <h1>Liste des types des articles</h1>
    <table class="table table-success table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Désignation</th>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['agent', 'responsable'])): ?>
                    <th></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($type->id); ?></td>
                    <td><?php echo e($type->code); ?></td>
                    <td><?php echo e($type->designation); ?></td>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['agent', 'responsable'])): ?>
                        <td class="tabButtonContainer">
                            <a class="buttonLinksTab btn-success" href="<?php echo e(route('type_article.edit', $type->id)); ?>"><i
                                    class="fa-solid fa-file-pen"></i></a>
                            <form class="delete" action="<?php echo e(route('type_article.destroy', $type->id)); ?>" method="post">
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

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/type_article/index.blade.php ENDPATH**/ ?>