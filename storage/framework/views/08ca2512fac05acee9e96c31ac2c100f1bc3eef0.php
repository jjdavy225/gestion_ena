<?php $__env->startSection('titre'); ?>
    Liste des STOCKS
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenu'); ?>
    <?php if(Session::has('info')): ?>
        <div class="alert alert-primary">
            <?php echo e(Session::get('info')); ?>

        </div>
    <?php endif; ?>
    <div class="linksContainer">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['agent', 'responsable'])): ?>
            <a class="buttonLinks" href="<?php echo e(route('stock.create')); ?>">Nouveau stock</a>
        <?php endif; ?>
    </div>
    <h1>Liste des articles</h1>
    <table class="table table-success table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Nature</th>
                <th>Nb d'articles en stock</th>
                <th>Nb d'entrées</th>
                <th>Nb de sorties</th>
                <th>Nb de retours</th>
                <th>Jour</th>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['agent', 'responsable'])): ?>
                    <th></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($stock->id); ?></td>
                    <td><?php echo e($stock->code); ?></td>
                    <td><?php echo e($stock->nature); ?></td>
                    <td><?php echo e($stock->stock); ?></td>
                    <td><?php echo e($stock->entree); ?></td>
                    <td><?php echo e($stock->sortie); ?></td>
                    <td><?php echo e($stock->retour); ?></td>
                    <td><?php echo e($stock->jour); ?></td>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['agent', 'responsable'])): ?>
                        <td class="tabButtonContainer">
                            <a class="buttonLinksTab" href="<?php echo e(route('stock.show', $stock->id)); ?>">Consulter</a>
                            <a class="buttonLinksTab" href="<?php echo e(route('stock.edit', $stock->id)); ?>">Modifier</a>
                            <a class="buttonLinksTab" href="<?php echo e(route('stock.destroy', $stock->id)); ?>">Supprimer</a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/stock/index.blade.php ENDPATH**/ ?>