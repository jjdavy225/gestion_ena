<?php $__env->startSection('titre'); ?>
    <?php echo e($demande->code); ?>

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
                    <th>Code de la demande</th>
                    <td><?php echo e($demande->code); ?></td>
                </tr>
                <tr>
                    <th>Date de demande</th>
                    <td><?php echo e($demande->date); ?></td>
                </tr>
                <tr>
                    <th>Objet</th>
                    <td><?php echo e($demande->objet); ?></td>
                </tr>
                <tr>
                    <th>Fiche</th>
                    <td><?php echo e($demande->fiche); ?></td>
                </tr>
                <tr>
                    <th>Delai</th>
                    <td><?php echo e($demande->delai); ?></td>
                </tr>
                <tr>
                    <th>Agent</th>
                    <td><?php echo e($demande->agent->nom); ?> <?php echo e($demande->agent->prenom); ?></td>
                </tr>
                <tr>
                    <th>Code secteur</th>
                    <td><?php echo e($demande->code_secteur); ?></td>
                </tr>
                <tr>
                    <th>Code propriétaire</th>
                    <td><?php echo e($demande->code_proprietaire); ?></td>
                </tr>
                <tr>
                    <th>Statut</th>
                    <td>
                        <?php if($demande->statut == 'D1S'): ?>
                            Non validée
                        <?php elseif($demande->statut == 'D1V'): ?>
                            En attente de sortie
                        <?php elseif($demande->statut == 'D1P'): ?>
                            Partiel
                        <?php elseif($demande->statut == 'D1T'): ?>
                            Complètement sortie
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </div>
        <?php if($demande->sorties()->count() != 0): ?>
            <div>
                <h1>Les sorties concernées</h1>
                <table class="table table-bordered">
                    <thead>
                        <th>Code de la sortie</th>
                        <th>Bureau de destination</th>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $demande->sorties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sortie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($sortie->code); ?> <a href="<?php echo e(route('sortie.show', $sortie->id)); ?>"><i
                                            class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i></a></td>
                                <td><?php echo e($sortie->bureau->designation); ?>-<?php echo e($sortie->bureau->site->designation); ?> <a
                                        href="<?php echo e(route('patrimoine.show', $sortie->bureau->id)); ?>"><i
                                            class="fa-solid fa-arrow-up-right-from-square text-warning mx-1"></i></a></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
    <h4 class="text-center">Les articles demandés</h4>
    <table class="table table-bordered">
        <thead>
            <th>Désignation</th>
            <th>Marque</th>
            <th>Qte demandée</th>
            <th>Qte sortie</th>
            <th>Qte restante</th>
        </thead>
        <tbody>
            <?php $__currentLoopData = $demande->articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($article->designation); ?></td>
                    <td><?php echo e($article->marque->designation); ?></td>
                    <td><?php echo e($article->pivot->quantite); ?></td>
                    <td><?php echo e($article->pivot->quantite_sortie); ?></td>
                    <td><?php echo e($article->pivot->reste); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/demande/show.blade.php ENDPATH**/ ?>