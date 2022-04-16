<?php $__env->startSection('titre'); ?>
    Nouvelle commande
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
    <div class="container" style="display: none;" id="new_article_form">
        <?php if($errors->has('type') || $errors->has('marque') || $errors->has('designation')): ?>
            <script type="text/javascript">
                document.getElementById('new_article_form').style.display = 'block';
            </script>
        <?php endif; ?>

        <form action="<?php echo e(route('article.store')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="container mt-3">
                <h3 class="text-center">Renseignez les infos du nouvel article</h3>
            </div>
            <div class="row border rounded-5 p-4 mb-4 mt-4 shadow" id="conteneur_form_article">

                <div class="form-group mb-3">
                    <label class="form-label" class="label">Type de l'article</label>
                    <select class="form-select" name="type">
                        <option disabled selected>Choisissez un type</option>
                        <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($type->id); ?>"><?php echo e($type->designation); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    <input class="form-control" type="text" name="designation" id="designation"
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
                <div class="form-group mb-3">
                    <label class="form-label">Marque</label>
                    <select class="form-select" name="marque">
                        <option disabled selected>Choisissez une marque</option>
                        <?php $__currentLoopData = $marques; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marque): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($marque->id); ?>"><?php echo e($marque->designation); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                <div class="boutons">
                    <input id="new_article_valider" type="submit" class="btn btn-dark col-lg-2 shadow-sm" value="Valider">
                    <button type="button" id="fermer_new_article">Annuler</button>
                    <script type="text/javascript">
                        document.getElementById('fermer_new_article').addEventListener("click", (function() {
                            document.getElementById('new_article_form').style.display = 'none';
                        }))
                    </script>
                </div>

            </div>
        </form>
    </div>

    
    <div class="container-fluid">
        <div class="container">
            <form action="<?php echo e(route('commande.store')); ?>" method="post">
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
                                <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($article->designation); ?></td>
                                        <td><?php echo e($article->marque->designation); ?></td>
                                        <td><input class="checkbox styled checkbox-primary" id="<?php echo e($article->code); ?>"
                                                type="checkbox" name="articles[]" value="<?php echo e($article->id); ?>"
                                                <?php echo e(in_array($article->id, old('articles') ?: []) ? 'checked' : ''); ?>>
                                        </td>
                                        <script type="text/javascript">
                                            articles['<?php echo e($article->code); ?>'] = '<?php echo e($article->designation); ?>'+' '+'<?php echo e($article->marque->designation); ?>';
                                        </script>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="boutons">
                        <button type="button" id="activ_js">Ok</button>
                        <button type="button" id="activ_js_new_article">Nouvel article</button>
                    </div>

                    <div id="liste_article"></div>

                    <script type="text/javascript">
                        let texte = document.getElementById('liste_article');
                        let form = document.getElementById('new_article_form');
                        document.getElementById('activ_js').addEventListener("click", (function() {
                            let a = false;
                            texte.innerHTML = '<h5 class = "text-center mt-2">Entrer les quantités et les prix unitaires</h5>'
                            for (let article in articles) {
                                if (document.getElementById(article).checked == true) {
                                    a = true;
                                    texte.innerHTML += '<div class="form-group mb-3"><label class="form-label">' + articles[
                                            article] +
                                        '</label><div class="row"><div class="col-lg-6"><input class="form-control" type="number" name="qtes[]" placeholder="Quantité" required></div><div class="col-lg-6"><input class="form-control" type="number" name="pu_s[]" placeholder="Prix unitaire" required></div></div></div>'
                                    document.getElementById('submit_all_js').innerHTML =
                                        '<input class="btn btn-dark col-lg-2 offset-5 shadow-sm" type="submit" value="Valider">'
                                }
                            }
                            if (!a) {
                                texte.innerHTML =
                                    '<h5 class="text-center" style="color:red;">CHOISSSEZ AU MOINS UN ARTICLE</h5>';
                                document.getElementById('submit_all_js').innerHTML = '';
                            }
                        }))
                        document.getElementById('activ_js_new_article').addEventListener("click", (function() {
                            form.style.display = 'block';
                        }))
                    </script>
                </div>

                <div class="container mt-3">
                    <h3 class="text-center">Renseignez votre commande</h3>
                </div>

                <div class="row border rounded-5 p-4 mb-4 mt-4 shadow">
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="date">Date de commande</label>
                            <input class="form-control" type="date" name="date" id="date" value="<?php echo e(old('date')); ?>">
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
                            <label class="form-label" for="objet">Objet de la commande</label>
                            <input class="form-control" type="text" name="objet" id="objet" value="<?php echo e(old('objet')); ?>">
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
                            <label class="form-label" for="num_fact">Numéro de la facture</label>
                            <input class="form-control" type="text" name="num_fact" id="num_fact"
                                value="<?php echo e(old('num_fact')); ?>">
                            <?php $__errorArgs = ['num_fact'];
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
                            <label class="form-label" for="date_fact">Date de la facture</label>
                            <input class="form-control" type="date" name="date_fact" id="date_fact"
                                value="<?php echo e(old('date_fact')); ?>">
                            <?php $__errorArgs = ['date_fact'];
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
                            <label class="form-label" for="remise">Remise</label>
                            <input class="form-control" type="number" name="remise" id="remise"
                                value="<?php echo e(old('remise')); ?>">
                            <?php $__errorArgs = ['remise'];
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
                            <label class="form-label" for="tva">Taux de valeur ajoutée</label>
                            <input class="form-control" type="number" name="tva" id="tva" value="<?php echo e(old('tva')); ?>">
                            <?php $__errorArgs = ['tva'];
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
                            <label class="form-label" for="montant">Montant</label>
                            <input class="form-control" type="number" name="montant" id="montant"
                                value="<?php echo e(old('montant')); ?>">
                            <?php $__errorArgs = ['montant'];
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
                            <label class="form-label" for="delai_paie">Delai de paiement</label>
                            <input class="form-control" type="number" name="delai_paie" id="delai_paie"
                                value="<?php echo e(old('delai_paie')); ?>">
                            <?php $__errorArgs = ['delai_paie'];
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
                            <label class="form-label" for="delai_liv">Delai de livraison</label>
                            <input class="form-control" type="number" name="delai_liv" id="delai_liv"
                                value="<?php echo e(old('delai_liv')); ?>">
                            <?php $__errorArgs = ['delai_liv'];
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
                            <label class="form-label" for="date_liv">Date de livraison</label>
                            <input class="form-control" type="date" name="date_liv" id="date_liv"
                                value="<?php echo e(old('date_liv')); ?>">
                            <?php $__errorArgs = ['date_liv'];
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
                            <label class="form-label" class="label">Fournisseur</label>
                            <select class="form-select" name="fournisseur">
                                <option disabled selected>Choisissez un fournisseur</option>
                                <?php $__currentLoopData = $fournisseurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fournisseur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($fournisseur->id); ?>"><?php echo e($fournisseur->sigle); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['fournisseur'];
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
                            <label class="form-label" for="frais">Frais</label>
                            <input class="form-control" type="number" name="frais" id="frais"
                                value="<?php echo e(old('frais')); ?>">
                            <?php $__errorArgs = ['frais'];
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
                            <label class="form-label" for="garantie">Garantie</label>
                            <input class="form-control" type="number" name="garantie" id="garantie"
                                value="<?php echo e(old('garantie')); ?>">
                            <?php $__errorArgs = ['garantie'];
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
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/commande/create.blade.php ENDPATH**/ ?>