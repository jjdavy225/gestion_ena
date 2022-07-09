<?php $__env->startSection('titre'); ?>
    <?php echo e($stock->code); ?>

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
                    <th>Numéro du stock</th>
                    <td><?php echo e($stock->code); ?></td>
                </tr>
                <tr>
                    <th>Date de création stock</th>
                    <td><?php echo e($stock->jour); ?></td>
                </tr>
                <tr>
                    <th>Nature du stock</th>
                    <td><?php echo e($stock->nature); ?></td>
                </tr>
                <tr>
                    <th>Nombre d'entrées</th>
                    <td><?php echo e($stock->entree); ?></td>
                </tr>
                <tr>
                    <th>Nombre de sorties</th>
                    <td><?php echo e($stock->sortie); ?></td>
                </tr>
                <tr>
                    <th>Nombre de retours</th>
                    <td><?php echo e($stock->retour); ?></td>
                </tr>
            </table>
        </div>
    </div>

    <h1>Contenu du stock</h1>
    <table class="table datatable">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Qte totale</th>
                <th>Qte entrée</th>
                <th>Qte sortie</th>
                <th>Qte retournée</th>
                <th>Désignation</th>
                <th>Marque</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i = 1
            ?>
            <?php $__currentLoopData = $stock->articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($i++); ?></td>
                    <td><?php echo e($article->code); ?></td>
                    <td><?php echo e($article->pivot->quantite_totale); ?></td>
                    <td><?php echo e($article->pivot->quantite_entree); ?></td>
                    <td><?php echo e($article->pivot->quantite_sortie); ?></td>
                    <td><?php echo e($article->pivot->quantite_retournee); ?></td>
                    <td><?php echo e($article->designation); ?></td>
                    <td><?php echo e($article->marque->designation); ?></td>
                    <td><?php echo e($article->type->designation); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/stock/show.blade.php ENDPATH**/ ?>