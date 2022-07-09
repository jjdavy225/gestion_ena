<?php $__env->startSection('titre'); ?>
    Nouvel article
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css1'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/style1.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenu'); ?>
    <div class="container">
        <form action="<?php echo e(route('article.store')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="container mt-3">
                <h3 class="text-center">Renseignez les infos du nouvel article</h3>
            </div>
            <div class="row border rounded-5 p-4 mb-4 mt-4 shadow" id="conteneur_form_article">

                <div class="toChange form-group mb-3">
                    <label class="toChangeLabel form-label">Type de l'article</label>
                    <select required class="selectChanger form-select" name="type">
                        <option value="">Choisissez un type</option>
                        <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($type->id); ?>"><?php echo e($type->designation); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <option class="new" value="new">Nouveau type</option>
                    </select>
                    <?php $__errorArgs = ['type'];
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
                    <label class="form-label" for="designation">Désignation</label>
                    <input required class="form-control" type="text" name="designation" id="designation"
                        value="<?php echo e(old('designation')); ?>">
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
                <div class="toChange form-group mb-3">
                    <label class="toChangeLabel form-label">Marque</label>
                    <select required class="selectChanger form-select" name="marque">
                        <option value="">Choisissez une marque</option>
                        <?php $__currentLoopData = $marques; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marque): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($marque->id); ?>"><?php echo e($marque->designation); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <option class="new" value="new">Nouvelle marque</option>
                    </select>
                    <?php $__errorArgs = ['marque'];
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
            <div class="boutons">
                <button type="submit">Valider</button>
            </div>
        </form>
    </div>
    <script>
        var selects = document.getElementsByClassName('selectChanger')
        var labels = document.getElementsByClassName('toChangeLabel')
        var divToChange = document.getElementsByClassName('toChange')
        var optionNew = document.getElementsByClassName('new')
        for (let i = 0; i < selects.length; i++) {
            selects[i].addEventListener('change', (function() {
                if (this.value === 'new') {
                    this.style.display = 'none'
                    var labelPrevious = labels[i].innerHTML
                    if (i == 0) {
                        labels[i].innerHTML = 'Désignation du nouveau type' +
                            '<button class="btn btn-outline-dark btn-sm ms-3" title="Annuler" type="button"><i class="fa-solid fa-circle-xmark"></i></button>'
                    } else {
                        labels[i].innerHTML = 'Désignation de la nouvelle marque' +
                            '<button class="btn btn-outline-dark btn-sm ms-3" title="Annuler" type="button"><i class="fa-solid fa-circle-xmark"></i></button>'
                    }
                    var newTypeField = document.createElement('input');
                    newTypeField.setAttribute('class', 'form-control')
                    newTypeField.setAttribute('required', '')
                    newTypeField.setAttribute('type', 'text')
                    newTypeField.setAttribute('maxlength', 30)
                    divToChange[i].appendChild(newTypeField);
                    newTypeField.focus()
                    labels[i].querySelector('button').addEventListener('click', (function() {
                        labels[i].innerHTML = labelPrevious
                        newTypeField.remove()
                        selects[i].style.display = 'block'
                        selects[i].querySelector("option").selected = true
                    }))
                    newTypeField.addEventListener('change', (function() {
                        newTypeField.remove()
                        var options = selects[i].querySelectorAll("option")
                        var optionBool = false
                        for (let i = 0; i < options.length; i++) {
                            if (options[i].innerHTML.toLowerCase() === this.value.toLowerCase()) {
                                options[i].selected = true
                                labels[i].innerHTML = labelPrevious
                                selects[i].style.display = 'block'
                                optionBool = true
                                break
                            }
                        }
                        if (!optionBool) {
                            var newOption = document.createElement('option')
                            if (i == 0) {
                                selects[i].setAttribute('name', 'newType')
                            } else {
                                selects[i].setAttribute('name', 'newMarque')
                            }
                            newOption.innerHTML = this.value
                            newOption.setAttribute('selected', '')
                            selects[i].insertBefore(newOption, optionNew[i])
                            labels[i].innerHTML = labelPrevious
                            selects[i].style.display = 'block'
                            selects[i].addEventListener('change', (function() {
                                if (this.value === newOption.value) {
                                    if (i == 0) {
                                        selects[i].setAttribute('name', 'newType')
                                    } else {
                                        selects[i].setAttribute('name', 'newMarque')
                                    }
                                }
                            }))
                        }
                    }))
                } else {
                    if (i == 0) {
                        selects[i].setAttribute('name', 'type')
                    } else {
                        selects[i].setAttribute('name', 'marque')
                    }
                }
            }))
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/article/create.blade.php ENDPATH**/ ?>