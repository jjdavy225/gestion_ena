<?php $__env->startSection('titre'); ?>
    Liste des demandes
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css1'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/style1.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenu'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['agent', 'responsable'])): ?>
        <div class="linksContainer">
            <a class="buttonLinks" href="<?php echo e(route('demande.create')); ?>"><i class="fa-solid fa-plus"></i></a>
        </div>
    <?php endif; ?>
    <h1>Liste des demandes</h1>
    <div class="container">

        <table class="table datatable">
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
                    $i = 1;
                ?>
                <?php $__currentLoopData = $demandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($i++); ?></td>
                        <td><?php echo e($demande->code); ?></td>
                        <td><?php echo e($demande->objet); ?></td>
                        <td>
                            <?php if($demande->statut == 'D1S'): ?>
                                Demande non validée
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
                                <td><input type="checkbox" class="demande" value="<?php echo e($demande->id); ?>">
                                </td>
                            <?php else: ?>
                                <td>Demande validée</td>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['agent', 'responsable'])): ?>
                            <td class="tabButtonContainer">
                                <a class="buttonLinksTab btn-primary" href="<?php echo e(route('demande.show', $demande->id)); ?>"><i
                                        class="fa-solid fa-file-lines"></i></a>
                                <a class="buttonLinksTab btn-success" href="<?php echo e(route('demande.edit', $demande->id)); ?>"><i
                                        class="fa-solid fa-file-pen"></i></a>
                                <form class="delete" action="<?php echo e(route('demande.destroy', $demande->id)); ?>" method="post">
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
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('responsable')): ?>
            <?php if($check): ?>
                <form action="<?php echo e(route('demande.validation')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="container text-center">
                        <input type="hidden" name="demandes[]" id="dem">
                        <input class="btn btn-danger" id="submit" type="submit" value="Valider">
                    </div>
                </form>
                <script>
                    document.getElementById('submit').addEventListener('click', (function() {
                        const demandes = document.getElementsByClassName('demande');
                        let dem = [];
                        for (let i = 0; i < demandes.length; i++) {
                            if (demandes[i].checked) {
                                dem.push(demandes[i].value);
                            }
                        }
                        document.getElementById('dem').value = dem;
                    }))
                </script>
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/demande/index.blade.php ENDPATH**/ ?>