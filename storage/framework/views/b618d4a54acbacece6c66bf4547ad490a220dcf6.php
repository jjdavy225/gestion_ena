<?php $__env->startSection('titre'); ?>
    Création de stock
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenu'); ?>
    <div class="container mt-3">
        <h3 class="text-center">Renseignez le nouveau stock</h3>
    </div>
    <div class="container">
        <form method="POST" action="<?php echo e(route('stock.store')); ?>">
            <?php echo csrf_field(); ?>
            <div class="row border rounded-5 p-4 mb-4 mt-4 shadow">
                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label class="form-label" for="initial">Initial</label>
                        <input class="form-control" type="number" name="initial" id="initial"
                            value="<?php echo e(old('initial')); ?>">
                        <?php $__errorArgs = ['initial'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="alert alert-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label class="form-label" for="exercice_code">Code d'exercice</label>
                        <input class="form-control" type="text" name="exercice_code" id="exercice_code"
                            value="<?php echo e(old('exercice_code')); ?>">
                        <?php $__errorArgs = ['exercice_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="alert alert-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    
                </div>
                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label class="form-label" for="nature">Nature</label>
                        <input class="form-control" type="text" name="nature" id="nature" value="<?php echo e(old('nature')); ?>">
                        <?php $__errorArgs = ['nature'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="alert alert-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="montant_initial">Montant initial</label>
                        <input class="form-control" type="number" name="montant_initial" id="montant_initial"
                            value="<?php echo e(old('montant_initial')); ?>">
                        <?php $__errorArgs = ['montant_initial'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="alert alert-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    
                </div>
                <input class="btn btn-dark col-lg-2 offset-5" type="submit" value="Soumettre">
            </div>
        </form>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/stock/create.blade.php ENDPATH**/ ?>