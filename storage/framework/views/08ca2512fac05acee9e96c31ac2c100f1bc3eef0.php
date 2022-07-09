<?php $__env->startSection('titre'); ?>
    Liste des STOCKS
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenu'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['agent', 'responsable'])): ?>
        <div class="linksContainer">
            <a class="buttonLinks" href="<?php echo e(route('stock.create')); ?>"><i class="fa-solid fa-plus"></i></a>
        </div>
    <?php endif; ?>
    <h1>La liste des stocks</h1>
    <table class="table datatable" id="example">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Nature</th>
                <th>Nb d'articles en stock</th>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['agent', 'responsable'])): ?>
                    <th></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php
                $i = 1
            ?>
            <?php $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($i++); ?></td>
                    <td><?php echo e($stock->code); ?></td>
                    <td><?php echo e($stock->nature); ?></td>
                    <td><?php echo e($stock->stock); ?></td>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['agent', 'responsable'])): ?>
                        <td class="tabButtonContainer">
                            <a class="buttonLinksTab btn-primary" href="<?php echo e(route('stock.show', $stock->id)); ?>"><i
                                    class="fa-solid fa-folder-open"></i></a>
                            <a class="buttonLinksTab btn-success" href="<?php echo e(route('stock.edit', $stock->id)); ?>"><i
                                    class="fa-solid fa-file-pen"></i></a>
                            <form class="delete" action="<?php echo e(route('stock.destroy', $stock->id)); ?>" method="post">
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

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/stock/index.blade.php ENDPATH**/ ?>