<?php $__env->startSection('titre'); ?>
    Liste des commandes
<?php $__env->stopSection(); ?>



<?php $__env->startSection('contenu'); ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['agent', 'responsable'])): ?>
        <div class="linksContainer">
            <a class="buttonLinks" title="Nouvelle commande" href="<?php echo e(route('commande.create')); ?>"><i
                    class="fa-solid fa-plus"></i></a>
            <a class="buttonLinks" title="Nouvelle livraison" href="<?php echo e(route('livraison.create')); ?>"><i
                    class="fa-solid fa-cart-plus"></i></a>
        </div>
    <?php endif; ?>

    <h1>Liste des commandes</h1>
    <div class="container">
        <table class="table datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Objet</th>
                    <th>Statut de livraison</th>
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
                    $i = 1
                ?>
                <?php $__currentLoopData = $commandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($i++); ?></td>
                        <td><?php echo e($commande->num); ?></td>
                        <td><?php echo e($commande->objet); ?></td>
                        <td>
                            <?php if($commande->statut_liv == 'C1S'): ?>
                                Commande non validée
                            <?php elseif($commande->statut_liv == 'C1V'): ?>
                                Non livrée
                            <?php elseif($commande->statut_liv == 'C1P'): ?>
                                Partielle
                            <?php elseif($commande->statut_liv == 'C1T'): ?>
                                Totale
                            <?php endif; ?>
                        </td>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('responsable')): ?>
                            <?php if($commande->statut_liv == 'C1S'): ?>
                                <?php
                                    $check = true;
                                ?>
                                <td><input class="commande" type="checkbox" value="<?php echo e($commande->id); ?>">
                                </td>
                            <?php else: ?>
                                <td>Commande validée</td>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['agent', 'responsable'])): ?>
                            <td class="tabButtonContainer">
                                <a class="buttonLinksTab btn-primary" href="<?php echo e(route('commande.show', $commande->id)); ?>"><i
                                        class="fa-solid fa-file-lines"></i></a>
                                <a class="buttonLinksTab btn-success" href="<?php echo e(route('commande.edit', $commande->id)); ?>"><i
                                        class="fa-solid fa-file-pen"></i></a>
                                <form class="delete" action="<?php echo e(route('commande.destroy', $commande->id)); ?>" method="post">
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
                <form action="<?php echo e(route('commande.validation')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="container text-center">
                        <input type="hidden" name="commandes[]" id="com">
                        <input class="btn btn-danger" id="submit" type="submit" value="Valider">
                    </div>
                </form>
                <script>
                    document.getElementById('submit').addEventListener('click', (function() {
                        const commandes = document.getElementsByClassName('commande');
                        let com = [];
                        for (let i = 0; i < commandes.length; i++) {
                            if (commandes[i].checked) {
                                com.push(commandes[i].value);
                            }
                        }
                        document.getElementById('com').value = com;
                    }))
                </script>
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/commande/index.blade.php ENDPATH**/ ?>