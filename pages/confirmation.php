<section class="layout" id="white">
	<div class="container">
		<h1 class="titre text-uppercase"><span class="fas fa-angle-double-right"></span> Confirmation action</h1>
	</div>
</section>
<section class="layout" id="page"><div class="container"><br/>
    <div class="container text-white">
		
		<!-- Présentation -->
		<div class="info-container">
			<h3><strong><span class="fas fa-info-circle"></span> Demande de confirmation</strong></h3>
			<p>
				Confirmez vos actions pour être sûr de ce que vous allez faire.
			</p>
		</div>


            <div class="row mt-3">

                <?php
                if (isset($_GET['choix'])) :

                    if (isset($_GET['id_topic'])) {
                        $id = htmlspecialchars($_GET['id_topic']);
                    }

                    $choix = htmlspecialchars($_GET['choix']);


                    if (isset($id)) :
                        //vérification + initialisation variable
                        if (is_numeric($id) && is_numeric($choix)) :
                            switch ($choix):

                                case '2':

                                    if (Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'deleteTopic')) : ?>

                                        <!-- Suppression d'un topic -->

                                        <div class="alert alert-danger w-100 text-center font-weight-bold">
                                            <i class="fas fa-exclamation-triangle"></i> Si vous supprimez cette discussion elle ne sera plus jamais accessible !
                                        </div>
                                        <div class="card w-100">
                                            <form action="<?= $_Serveur_['General']['url']; ?>?&action=forum_moderation&id_topic=<?= $id; ?>&choix=2&confirmation=true" method="post">

                                                <div class="card-header bg-parabellum">
                                                    <h4>Suppression d'un topic</h4>
                                                </div>

                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="reason" class="color-red">Raison de la suppression</label>
                                                        <input type="text" class="form-control" id="reason" name="reason" placeholder="Votre raison" required />
                                                    </div>
                                                    <div class="form-row">

                                                    </div>
                                                </div>

                                                <div class="card-footer">
                                                    <div class="row m-3">
                                                        <div>
                                                            <button type="submit" class="btn btn-parabellumW">Supprimer ce topic</button>
                                                        </div>
                                                        <div class="ml-auto">
                                                            <a href="index.php" class="btn btn-warning">Annuler</a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>

                                    <?php else :
                                        header('Location: ?page=erreur&erreur=7');
                                    endif ?>

                                    <?php break; ?>


                                <?php
                                case '3': ?>

                                    <?php if (Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'mooveTopic')) : ?>

                                        <!-- Déplacement d'une discussion -->

                                        <div class="card w-100">
                                            <form action="<?= $_Serveur_['General']['url']; ?>?&action=forum_moderation&id_topic=<?= $id; ?>&choix=3&confirmation=true" method="post">

                                                <div class="card-header bg-parabellum">
                                                    <h4>Déplacement d'une discussion</h4>
                                                </div>
                                                <div class="card-body">

                                                    <div class="form-group">
                                                        <label for="emplacement" class="color-red">Déplacez la discussion vers : </label>
                                                        <select class="form-control" name="emplacement" id="emplacement" required>

                                                            <?php
                                                            $emplacement = $bddConnection->query('SELECT * FROM cmw_forum_categorie');
                                                            while ($emplacementd = $emplacement->fetch(PDO::FETCH_ASSOC)) :
                                                                if (isset($emplacementd['sous-forum'])) : ?>

                                                                    <optgroup label="<?= $emplacementd['nom']; ?>">

                                                                        <option value="<?= $emplacementd['id']; ?>">Déplacer dans la catégorie</option>
                                                                        <?php
                                                                        $sous_forum = $bddConnection->prepare('SELECT * FROM cmw_forum_sous_forum WHERE id_categorie = :id');
                                                                        $sous_forum->execute(array(
                                                                            'id' => $emplacementd['id']
                                                                        ));

                                                                        while ($sous_forumd = $sous_forum->fetch(PDO::FETCH_ASSOC)) : ?>

                                                                            <option value="<?= $emplacementd['id']; ?>_<?= $sous_forumd['id']; ?>">
                                                                                <?= $sous_forumd['nom']; ?>
                                                                            </option>

                                                                        <?php endwhile; ?>
                                                                    </optgroup>
                                                                <?php else : ?>
                                                                    <option value="<?= $emplacementd['id']; ?>_0">
                                                                        <?= $emplacementd['nom']; ?>
                                                                    </option>
                                                                <?php endif; ?>
                                                            <?php endwhile; ?>

                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="card-footer">
                                                    <div class="row m-3">
                                                        <div>
                                                            <button type="submit" class="btn btn-parabellumW">Déplacer la discussion</button>
                                                        </div>
                                                        <div class="ml-auto">
                                                            <a href="index.php" class="btn btn-warning">Annuler</a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>

                                    <?php else :
                                        header('Location: ?page=erreur&erreur=7');
                                    endif; ?>

                                    <?php break; ?>

                                <?php
                                case '4': ?>

                                    <!-- Signalement d'une réponse -->

                                    <div class="card w-100">
                                        <form action="?&action=signalement&confirmation=true" method="post">

                                            <div class="card-header bg-parabellum">
                                                <h4>Raison d'un signalement d'un message</h4>
                                            </div>

                                            <div class="card-body">

                                                <input type="hidden" name="id_answer" value="<?= $_GET['id']; ?>" />
                                                <div class="form-group">
                                                    <label for="reason" class="color-red">Indiquez une raison</label>
                                                    <input type="text" class="form-control" name="reason" id="reason" placeholder="Indiquez une raison" required />
                                                </div>

                                            </div>

                                            <div class="card-footer">
                                                <div class="row m-3">
                                                    <div>
                                                        <button type="submit" class="btn btn-parabellumW">Déplacer la discussion</button>
                                                    </div>
                                                    <div class="ml-auto">
                                                        <a href="index.php" class="btn btn-warning">Annuler</a>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                    </div>

                                    <?php break; ?>

                                <?php
                                case '5': ?>

                                    <!-- Signalement d'un topic -->

                                    <div class="card w-100">
                                        <form action="?&action=signalement&confirmation=true" method="post">

                                            <div class="card-header bg-parabellum">
                                                <h4>Raison d'un signalement d'un topic</h4>
                                            </div>

                                            <div class="card-body">

                                                <input type="hidden" name="id_topic2" value="<?= $_GET['id']; ?>" />
                                                <div class="form-group">
                                                    <label for="reason" class="color-red">Indiquez une raison</label>
                                                    <input type="text" class="form-control" name="reason" id="reason" placeholder="Indiquez une raison" required />
                                                </div>

                                            </div>

                                            <div class="card-footer">
                                                <div class="row m-3">
                                                    <div>
                                                        <button type="submit" class="btn btn-parabellumW">Déplacer la discussion</button>
                                                    </div>
                                                    <div class="ml-auto">
                                                        <a href="index.php" class="btn btn-warning">Annuler</a>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                    </div>

                                    <?php break; ?>

                            <?php endswitch; ?>
                        <?php endif; ?>
                    <?php endif; ?>

                <?php else :
                    header('Location: ?page=erreur&erreur=7');
                endif;
                ?>

            </div>
			
    </div>
</section>