<?php $__env->startSection('titre'); ?>
    <?php echo e($inventaire->code); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css1'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/style1.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenu'); ?>
    <div class="tableShowContainer">
        <div>
            <h1>Infos</h1>
            <table class="table table-bordered">
                <tr>
                    <th>Code de l'inventaire</th>
                    <td><?php echo e($inventaire->code); ?></td>
                </tr>
                <tr>
                    <th>Date de réalisation de l'inventaire</th>
                    <td><?php echo e($inventaire->created_at); ?></td>
                </tr>
                <tr>
                    <th>Nature de l'inventaire</th>
                    <td><?php echo e($inventaire->nature); ?></td>
                </tr>
            </table>
        </div>
    </div>
    <h1>Les articles inventoriés</h1>
    <table class="table datatable">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Quantité</th>
                <th>Nature du stock</th>
                <th>Désignation</th>
                <th>Marque</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i = 1;
            ?>
            <?php $__currentLoopData = $inventaire->articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($i++); ?></td>
                    <td><?php echo e($article->code); ?></td>
                    <td><?php echo e($article->pivot->quantite); ?></td>
                    <td><?php echo e($article->pivot->nature_stock); ?></td>
                    <td><?php echo e($article->designation); ?></td>
                    <td><?php echo e($article->marque->designation); ?></td>
                    <td><?php echo e($article->type->designation); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/inventaire/show.blade.php ENDPATH**/ ?>