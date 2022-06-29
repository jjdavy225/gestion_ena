<?php $__env->startSection('titre'); ?>
    Liste des livraisons
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
        <a class="buttonLinks" href="<?php echo e(route('livraison.create')); ?>"><i class="fa-solid fa-plus"></i></a>
    <?php endif; ?>
    <h1>Liste des livraisons</h1>
    <div class="container">
        <table class="table table-success table-stripped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Date de livraison</th>
                    <th>Commande concernée</th>
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
                <?php $__currentLoopData = $livraisons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $livraison): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($livraison->id); ?></td>
                        <td><?php echo e($livraison->code); ?></td>
                        <td><?php echo e($livraison->date); ?></td>
                        <td>
                            <a
                                href="<?php echo e(route('commande.show', $livraison->commande->id)); ?>"><?php echo e($livraison->commande->num); ?></a>
                        </td>
                        <td>
                            <?php if($livraison->statut == 'L1S'): ?>
                                Livraison non validée
                            <?php elseif($livraison->statut == 'L1V'): ?>
                                Livraison éffectuée
                            <?php endif; ?>
                        </td>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('responsable')): ?>
                            <?php if($livraison->statut == 'L1S'): ?>
                                <?php
                                    $check = true;
                                ?>
                                <td><input class="livraison" type="checkbox" value="<?php echo e($livraison->id); ?>"></td>
                            <?php else: ?>
                                <td>Livraison validée</td>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['agent', 'responsable'])): ?>
                            <td class="tabButtonContainer">
                                <a class="buttonLinksTab" href="<?php echo e(route('livraison.show', $livraison->id)); ?>"><i
                                        class="fa-solid fa-file-lines"></i></a>
                                <a class="buttonLinksTab" href="<?php echo e(route('livraison.edit', $livraison->id)); ?>"><i
                                        class="fa-solid fa-file-pen"></i></a>
                                <form class="delete" onsubmit="return confirm('Do you really want to submit the form ?');"
                                    action="<?php echo e(route('livraison.destroy', $livraison->id)); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="buttonLinksTab"><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('responsable')): ?>
            <?php if($check): ?>
                <form action="<?php echo e(route('livraison.validation')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="container text-center">
                        <input type="hidden" name="livraisons[]" id="liv">
                        <input class="btn btn-dark" id="submit" type="submit" value="Valider">
                    </div>
                </form>
                <script>
                    document.getElementById('submit').addEventListener('click', (function() {
                        const livraisons = document.getElementsByClassName('livraison');
                        let liv = [];
                        for (let i = 0; i < livraisons.length; i++) {
                            if (livraisons[i].checked) {
                                liv.push(livraisons[i].value);
                            }
                        }
                        document.getElementById('liv').value = liv;
                    }))
                </script>
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/livraison/index.blade.php ENDPATH**/ ?>