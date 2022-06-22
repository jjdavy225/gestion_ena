<?php $__env->startSection('titre'); ?>
    Fournisseurs
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenu'); ?>
<div class="linksContainer">
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['agent', 'responsable'])): ?>
        <a class="buttonLinks" href="<?php echo e(route('fournisseur.create')); ?>">Nouveau fournisseur</a>
    <?php endif; ?>
</div>
    <h1>Liste des fournisseurs</h1>
    <table class="table table-success table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Sigle</th>
                <th>Siège</th>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['agent', 'responsable'])): ?>
                    <th></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $fournisseurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fournisseur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($fournisseur->id); ?></td>
                    <td><?php echo e($fournisseur->code); ?></td>
                    <td><?php echo e($fournisseur->sigle); ?></td>
                    <td><?php echo e($fournisseur->siege); ?></td>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['agent', 'responsable'])): ?>
                        <td class="tabButtonContainer">
                            <a class="buttonLinksTab" href="<?php echo e(route('fournisseur.show', $fournisseur->id)); ?>">Voir</a>
                            <a class="buttonLinksTab" href="<?php echo e(route('fournisseur.edit', $fournisseur->id)); ?>">Modifier</a>
                            <a class="buttonLinksTab" href="<?php echo e(route('fournisseur.destroy', $fournisseur->id)); ?>">Supprimer</a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/fournisseur/index.blade.php ENDPATH**/ ?>