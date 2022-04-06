<form action="<?php echo e(route('article.store')); ?>" method="post">
    <?php echo csrf_field(); ?>
    <div class="container mt-3">
        <h3 class="text-center">Renseignez les infos du nouvel article</h3>
    </div>
    <div class="row border rounded-5 p-4 mb-4 mt-4 shadow" id="conteneur_form_article">

        <div class="form-group mb-3">
            <label class="form-label" class="label">Type de l'article</label>
            <select class="form-select" name="type_id">
                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($type->id); ?>"><?php echo e($type->designation); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="form-group mb-3">
            <label class="form-label" for="objet">Désignation</label>
            <input class="form-control" type="text" name="objet" id="objet" value="<?php echo e(old('objet')); ?>">
            <?php $__errorArgs = ['objet'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group mb-3">
            <label class="form-label">Marque</label>
            <select class="form-select" name="marque_id">
                <?php $__currentLoopData = $marques; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marque): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($marque->id); ?>"><?php echo e($marque->designation); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <input class="btn btn-dark col-lg-2 offset-5 shadow-sm" type="submit" value="Valider">

    </div>
</form>
<?php /**PATH /home/davy/gestion_ena/resources/views/commande/new_article.blade.php ENDPATH**/ ?>