<?php $__env->startSection('titre'); ?>
    Liste des demandes
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css1'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/style1.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenu'); ?>
    <?php if(Session::has('info')): ?>
        <div class="alert alert-primary">
            <?php echo e(Session::get('info')); ?>

        </div>
    <?php endif; ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['agent', 'responsable'])): ?>
        <a class="buttonLinks" href="<?php echo e(route('demande.create')); ?>"><i class="fa-solid fa-plus"></i></a>
    <?php endif; ?>
    <h1>Liste des demandes</h1>
    <div class="container">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('responsable')): ?>
            <form action="<?php echo e(route('demande.validation')); ?>" method="post">
                <?php echo csrf_field(); ?>
            <?php endif; ?>
            <table class="table table-success table-stripped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Objet</th>
                        <th>Statut</th>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('responsable')): ?>
                            <th>Choix pour validation</th>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['agent', 'responsable'])): ?>
                            <th></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $check = false;
                    ?>
                    <?php $__currentLoopData = $demandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($demande->id); ?></td>
                            <td><?php echo e($demande->code); ?></td>
                            <td><?php echo e($demande->objet); ?></td>
                            <td>
                                <?php if($demande->statut == 'D1S'): ?>
                                    Commande non validée
                                <?php elseif($demande->statut == 'D1V'): ?>
                                    Non livrée
                                <?php elseif($demande->statut == 'D1P'): ?>
                                    Partielle
                                <?php elseif($demande->statut == 'D1T'): ?>
                                    Totale
                                <?php endif; ?>
                            </td>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('responsable')): ?>
                                <?php if($demande->statut == 'D1S'): ?>
                                    <?php
                                        $check = true;
                                    ?>
                                    <td><input type="checkbox" name="demandes[]" value="<?php echo e($demande->id); ?>" id="articles">
                                    </td>
                                <?php else: ?>
                                    <td>Demande validée</td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['agent', 'responsable'])): ?>
                                <td class="tabButtonContainer">
                                    <a href="<?php echo e(route('demande.show', $demande->id)); ?>"><i
                                            class="fa-solid fa-file-lines"></i></a>
                                    <a href="<?php echo e(route('demande.edit', $demande->id)); ?>"><i
                                            class="fa-solid fa-file-pen"></i></a>
                                    <a href="<?php echo e(route('demande.destroy', $demande->id)); ?>"><i
                                            class="fa-solid fa-trash-can"></i></a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('responsable')): ?>
                <div class="container text-center">
                    <input class="btn btn-dark" type="submit" value="Valider">
                </div>
            </form>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/demande/index.blade.php ENDPATH**/ ?>