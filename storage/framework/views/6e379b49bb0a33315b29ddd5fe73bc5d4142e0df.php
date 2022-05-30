<?php $__env->startSection('titre'); ?>
    <?php echo e($stock->code); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css1'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/style1.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenu'); ?>
    <h1>Infos</h1>
    <ul class="show">
        <li>Numéro du stock : <?php echo e($stock->code); ?></li>
        <li>Date de création du stock : <?php echo e($stock->jour); ?></li>
        <li>Nature du stock : <?php echo e($stock->nature); ?></li>
        <li>Nombre d'entrées : <?php echo e($stock->entree); ?></li>
        <li>Nombre de retours : <?php echo e($stock->retour); ?></li>
        <li>Nombre de sorties : <?php echo e($stock->sortie); ?></li>
    </ul>
    <h4>Contenu du stock</h4>
    <table class="table table-success table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Quantité totale</th>
                <th>Quantité entrée</th>
                <th>Quantité retournée</th>
                <th>Désignation</th>
                <th>Marque</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $stock->articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($article->id); ?></td>
                    <td><?php echo e($article->code); ?></td>
                    <td><?php echo e($article->pivot->quantite_totale); ?></td>
                    <td><?php echo e($article->pivot->quantite_entree); ?></td>
                    <td><?php echo e($article->pivot->quantite_retournee); ?></td>
                    <td><?php echo e($article->designation); ?></td>
                    <td><?php echo e($article->marque->designation); ?></td>
                    <td><?php echo e($article->type->designation); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <button><a href="<?php echo e(route('stock.index')); ?>">Retour</a></button>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/stock/show.blade.php ENDPATH**/ ?>