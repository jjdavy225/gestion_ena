<?php $__env->startSection('titre'); ?>
    Modification de marque
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css1'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/style1.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenu'); ?>
    <div class="container">
        <form action="<?php echo e(route('marque_article.update',$marque->id)); ?>" method="post">
            <?php echo csrf_field(); ?>
            <?php echo method_field('put'); ?>
            <div class="container mt-3">
                <h3 class="text-center">Modifiez la marque</h3>
            </div>
            <div class="row border rounded-5 p-4 mb-4 mt-4 shadow" id="conteneur_form_article">
                <div class="form-group mb-3">
                    <label class="form-label" for="designation">Désignation</label>
                    <input class="form-control" type="text" name="designation" id="designation"
                        value="<?php echo e(old('designation', $marque->designation)); ?>">
                    <?php $__errorArgs = ['designation'];
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
                <div class="boutons">
                    <input id="new_article_valider" type="submit" value="Valider">
                </div>

            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena/resources/views/marque_article/edit.blade.php ENDPATH**/ ?>