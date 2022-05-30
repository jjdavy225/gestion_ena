<?php $__env->startSection('titre'); ?>
    Nouvelle demande
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css1'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/style1.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenu'); ?>
    <?php if(Session::has('errors_qte')): ?>
        <div class="alert alert-danger">
            <?php echo e(Session::get('errors_qte')); ?>

        </div>
    <?php endif; ?>
    <div class="container-fluid">
        <div class="container">
            <form action="<?php echo e(route('demande.store')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <h3 class="text-center">Choisissez vos articles</h3>
                <div class="form-group mb-3">
                    <div class="container" id="table_liste_article">
                        <table class="table table-success table-stripped">
                            <thead>
                                <tr>
                                    <th>Articles</th>
                                    <th>Marque</th>
                                    <th>Choix</th>
                                </tr>
                            </thead>
                            <tbody>
                                <script type="text/javascript">
                                    let articles = {};
                                </script>
                                <?php $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $stock->articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($article->pivot->quantite_totale > 0): ?>
                                            <tr>
                                                <td><?php echo e($article->designation); ?></td>
                                                <td><?php echo e($article->marque->designation); ?></td>
                                                <td><input class="checkbox styled checkbox-primary"
                                                        id="<?php echo e($article->code); ?>" type="checkbox" name="articles[]"
                                                        value="<?php echo e($article->id); ?>"
                                                        <?php echo e(in_array($article->id, old('articles') ?: []) ? 'checked' : ''); ?>>
                                                </td>
                                                <script type="text/javascript">
                                                    articles['<?php echo e($article->code); ?>'] = ['<?php echo e($article->designation); ?> <?php echo e($article->marque->designation); ?>',
                                                        '<?php echo e($article->pivot->quantite_totale); ?>'
                                                    ];
                                                </script>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="boutons">
                        <button type="button" id="activ_js">Ok</button>
                    </div>

                    <div id="liste_article"></div>

                    <script type="text/javascript">
                        const texte = document.getElementById('liste_article');
                        document.getElementById('activ_js').addEventListener("click", (function() {
                            let a = false;
                            texte.innerHTML = '<h5 class = "text-center mt-2">Entrer les quantités</h5>'
                            for (let article in articles) {
                                if (document.getElementById(article).checked == true) {
                                    a = true;
                                    texte.innerHTML +=
                                        '<div class="form-group mb-3 col-lg-6 mx-auto"><label class="form-label">' + articles[
                                            article][0] + ' | En stock : ' + articles[article][1] +
                                        '</label><input class="form-control" type="number" name="qtes[]" placeholder="Quantité" required min="0" max="' +
                                        articles[article][1] + '"></div>'

                                }
                            }
                            if (!a) {
                                texte.innerHTML =
                                    '<h5 class="text-center" style="color:red;">CHOISSSEZ AU MOINS UN ARTICLE</h5>';
                                document.getElementById('submit_all_js').innerHTML = '';
                            } else {
                                document.getElementById('submit_all_js').innerHTML =
                                    '<input class="btn btn-dark col-lg-2 offset-5 shadow-sm" type="submit" value="Valider">'
                            }
                        }))
                    </script>
                </div>

                <div class="container mt-3">
                    <h3 class="text-center">Renseignez votre demande</h3>
                </div>

                <div class="row border rounded-5 p-4 mb-4 mt-4 shadow">
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="date">Date de la demande</label>
                            <input required class="form-control" type="date" name="date" id="date"
                                value="<?php echo e(old('date')); ?>">
                            <?php $__errorArgs = ['date'];
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
                            <label class="form-label" for="objet">Objet de la demande</label>
                            <input required class="form-control" type="text" name="objet" id="objet"
                                value="<?php echo e(old('objet')); ?>">
                            <?php $__errorArgs = ['objet'];
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
                            <label class="form-label" for="fiche">Fiche</label>
                            <input required class="form-control" type="text" name="fiche" id="fiche"
                                value="<?php echo e(old('fiche')); ?>">
                            <?php $__errorArgs = ['fiche'];
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
                            <label class="form-label" for="delai">Delai</label>
                            <input required class="form-control" type="number" min="0" name="delai" id="delai"
                                value="<?php echo e(old('delai')); ?>">
                            <?php $__errorArgs = ['delai'];
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
                            <label class="form-label" for="code_secteur">Code secteur</label>
                            <input required class="form-control" type="text" name="code_secteur" id="code_secteur"
                                value="<?php echo e(old('code_secteur')); ?>">
                            <?php $__errorArgs = ['code_secteur'];
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
                            <label class="form-label" for="bureau">Bureau</label>
                            <select class="form-select" name="bureau" id="bureau">
                                <option disabled selected>Choisissez un bureau</option>
                                <?php $__currentLoopData = $bureaux; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bureau): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($bureau->id); ?>">
                                        <?php echo e($bureau->site->designation); ?>-<?php echo e($bureau->designation); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['demande'];
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
                </div>

                <div id="submit_all_js"></div>
            </form>
        </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/demande/create.blade.php ENDPATH**/ ?>