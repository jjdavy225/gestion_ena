<?php $__env->startSection('titre'); ?>
    Livraison
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css1'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/style1.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenu'); ?>
    <div class="container-fluid">
        <div class="container">
            <form action="<?php echo e(route('livraison.store')); ?>" method="post">
                <?php echo csrf_field(); ?>

                <div class="container mt-3">
                    <h3 class="text-center">Renseignez la livraison</h3>
                </div>

                <div class="container" id="conteneur_type_liv">
                    <h5 class="text-center">Choisissez le type de livraison</h5>
                    <div id="type_liv">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="liv" value="complete" id="complete">
                            <label class="form-check-label" for="complete">complète (tous les articles commandés)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="liv" value="partielle" id="partielle">
                            <label class="form-check-label" for="partielle">partielle</label>
                        </div>
                    </div>
                </div>

                <div class="row border rounded-5 p-4 mb-4 mt-4 shadow">
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="date">Date</label>
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
                        <div class="form-group mb-3">
                            <label class="form-label" for="delai">Delai</label>
                            <input class="form-control" type="number" name="delai" id="delai"
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
                            <label class="form-label" for="commande">Commande</label>
                            <select class="form-select" name="commande" id="commande">
                                <script>
                                    let commandes = {};
                                </script>
                                <option disabled selected>Choisissez une commande</option>
                                <?php $__currentLoopData = $commandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($commande->statut_liv != 'Livrée'): ?>
                                        <option value="<?php echo e($commande->id); ?>">Code : <?php echo e($commande->num); ?> |Objet :
                                            <?php echo e($commande->objet); ?></option>
                                        <script>
                                            commandes['<?php echo e($commande->id); ?>'] = {};
                                        </script>
                                        <?php $__currentLoopData = $commande->articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <script>
                                                commandes['<?php echo e($commande->id); ?>']['<?php echo e($article->designation); ?> <?php echo e($article->marque->designation); ?>'] = ['<?php echo e($article->id); ?>',
                                                    '<?php echo e($article->pivot->reste); ?>'
                                                ]
                                            </script>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['commande'];
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
                            <label class="form-label" for="stock">Stock</label>
                            <select class="form-select" name="stock" id="stock">
                                <option disabled selected>Choisissez le stock</option>
                                <?php $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($stock->id); ?>"><?php echo e($stock->nature); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['stock'];
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
                            <label class="form-label" for="num_bon">Numéro de bon</label>
                            <input class="form-control" type="text" name="num_bon" id="num_bon"
                                value="<?php echo e(old('num_bon')); ?>">
                            <?php $__errorArgs = ['num_bon'];
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
                            <label class="form-label" for="date_bon">Date de bon</label>
                            <input class="form-control" type="date" name="date_bon" id="date_bon"
                                value="<?php echo e(old('date_bon')); ?>">
                            <?php $__errorArgs = ['date_bon'];
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
                            <label class="form-label" for="fact_num">Numéro de la facture</label>
                            <input class="form-control" type="text" name="fact_num" id="fact_num"
                                value="<?php echo e(old('fact_num')); ?>">
                            <?php $__errorArgs = ['fact_num'];
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
                            <label class="form-label" for="fact_date">Date de la facture</label>
                            <input class="form-control" type="date" name="fact_date" id="fact_date"
                                value="<?php echo e(old('fact_date')); ?>">
                            <?php $__errorArgs = ['fact_date'];
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
                <div class="form-group mb-3" id="tab_article" style="display: none">
                    <script>
                        if (document.getElementById('partielle').checked) {
                            document.getElementById('tab_article').style.display = 'block'
                        }
                    </script>
                    <div class="container" id="table_liste_article">
                        <table class="table table-success table-stripped">
                            <thead>
                                <tr>
                                    <th>Articles</th>
                                    <th>Choix</th>
                                </tr>
                            </thead>
                            <tbody id="tab_choix_js">
                                <script type="text/javascript">
                                    const doc = document.getElementById('commande');
                                    const doc2 = document.getElementById('tab_choix_js');
                                    tab_choix(commandes[doc.value], doc2);
                                    doc.addEventListener('change', (function() {
                                        var articles_c = commandes[doc.value];
                                        tab_choix(articles_c, doc2);
                                    }))

                                    function tab_choix(articles, doc) {
                                        doc.innerHTML = ""
                                        for (var designation in articles) {
                                            var id = articles[designation][0]
                                            var reste = articles[designation][1]
                                            if (reste > 0) {
                                                doc.innerHTML += '<tr><td>' + designation +
                                                    '</td><td><input class="checkbox styled checkbox-primary" id="' + designation +
                                                    '"type="checkbox" name="articles[]" value="' + id + '"></td></tr>';
                                            }
                                        }
                                    }
                                </script>
                            </tbody>
                        </table>
                    </div>
                    <div class="boutons">
                        <button type="button" id="activ_js">Ok</button>
                    </div>

                    <div id="liste_article"></div>

                    <script type="text/javascript">
                        let texte = document.getElementById('liste_article');
                        document.getElementById('activ_js').addEventListener("click", (function() {
                            let a = false;
                            var articles_c = commandes[doc.value];
                            texte.innerHTML = '<h5 class = "text-center mt-2">Entrer les quantités livrées</h5>'
                            for (let designation in articles_c) {
                                var reste = articles_c[designation][1];
                                if (reste > 0) {
                                    if (document.getElementById(designation).checked == true) {
                                        a = true;
                                        texte.innerHTML +=
                                            '<div class="form-group mb-3 col-lg-6" style="margin-left:auto;margin-right:auto;"><label class="form-label">' +
                                            designation +
                                            '</label><input class="form-control" type="number" name="qtes[]" placeholder="Restant : '+ reste +'" required max="' +
                                            reste + '"></div>'
                                        document.getElementById('submit_all_js').innerHTML =
                                            '<input class="btn btn-dark col-lg-2 offset-5" type="submit" value="Soumettre">'
                                    }
                                }
                            }
                            if (!a) {
                                texte.innerHTML =
                                    '<h5 class="text-center" style="color:red;">CHOISSSEZ AU MOINS UN ARTICLE</h5>';
                                document.getElementById('submit_all_js').innerHTML = '';
                            }
                        }))
                    </script>
                </div>
                <div id="submit_all_js">
                </div>
                <script>
                    document.getElementById('partielle').addEventListener('change', (function() {
                        document.getElementById('submit_all_js').innerHTML = ''
                        document.getElementById('tab_article').style.display = 'block';
                    }));
                    document.getElementById('complete').addEventListener('change', (function() {
                        document.getElementById('submit_all_js').innerHTML =
                            '<input class="btn btn-dark col-lg-2 offset-5" type="submit" value="Soumettre">'
                        document.getElementById('tab_article').style.display = 'none';
                    }));
                </script>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.primary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/davy/gestion_ena_backup/resources/views/livraison/create.blade.php ENDPATH**/ ?>