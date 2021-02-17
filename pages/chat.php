<?php

if (count($jsonCon) > 0) {
    $Chat = new Chat($jsonCon);
}
?>

<section class="layout" id="white">
    <div class="container">
        <h1 class="titre text-uppercase"><span class="fas fa-comments"></span> Chat Minecraft</h1>
    </div>
</section>

<section class="layout" id="page">
    <div class="container">
        <?php if (count($jsonCon) > 0) : ?>
        <!-- Listing des serveurs -->
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-parabellum">
                        <h4 class="text-white mb-0">Serveurs :</h4>
                    </div>
                    <div class="card-body">
                        <ul class="nav flex-column" id="servEnLigne">
                            <?php foreach ($lectureJSON as $i => $serveur) : ?>
                                <li class="categorie-item nav-item<?= ($i == 0) ? ' active' : '' ?>">
                                    <a href="#server-<?= $i ?>" onclick="setTimeout(switchEnLigne, 500);" class="nav-link categorie-link<?= ($i == 0) ? ' active' : '' ?>" data-toggle="tab" data-id="<?=$i;?>">
                                        <i class="fas fa-angle-double-right"></i> <?= $serveur['nom']; ?>
                                    </a>
                                    <div style="<?= ($i == 0) ? '' : 'display: none;';?>" id="joueur<?=$i;?>">
                                        <?php $joueurs = $jsonCon[$i]->GetPlayers();
                                        if(empty($joueurs))
                                            echo "Pas de joueurs connectés";
                                        else
                                            foreach($joueurs as $value)
                                            {
                                                ?><img class="mr-3" src="<?=$_ImgProfil_->getUrlHeadByPseudo($value, 16);?>" style="width: 16px; height: 16px;" /><?=$value;?> <?=Permission::getInstance()->gradeJoueur($value);?><br />
                                            <?php } ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Affichage du Chat -->
            <div class="col-md-9">
                <div class="tab-content">
                    <?php for ($i = 0; $i < count($jsonCon); $i++) {
                        $messages = $Chat->getMessages($i); ?>
                        <div id="server-<?= $i ?>" class="tab-pane fade <?php if ($i == 0) echo 'in active show'; ?>" aria-expanded="false">
                            <div class="card">
                                <div class="card-header bg-parabellum">
                                    <h4 class="text-white mb-0"> Chat : </h4>
                                </div>
                                <div class="card-body" id="msgChat<?=$i;?>">
                                    <!-- Affichage du message -->
                                    <?php if ($messages != false && $messages != "erreur" && $messages != "query") {
                                        $messages = array_slice($messages, -10, 10);
                                        foreach ($messages as $value) { ?>

                                            <div class="media">
                                                <p class="username">
                                                    <img class="mr-3" src="<?= $_ImgProfil_->getUrlHeadByPseudo($value['player'], 32); ?>" style="width: 32px; height: 32px;" alt="avatar de l'auteur" />
                                                <div class="media-body">
                                                    <h5 class="mt-0">
                                                        <?= (empty($value['player'])) ? 'Console' : $value['player'] . ', ' . Permission::getInstance()->gradeJoueur($value['player']); ?>
                                                        <small class="font-weight-light float-right text-muted"><?= date('H:i', $value['time']); ?></small>
                                                    </h5>
                                                    <?= $Chat->formattage(htmlspecialchars($value['message'])); ?>
                                                </div>
                                                </p>
                                            </div>

                                        <?php } ?>
                                        <!-- Affichage des erreurs -->
                                    <?php } elseif ($messages == "query") { ?>
                                        <div class="tab-pane fade in show" aria-expanded="false">
                                            <div class="alert alert-info">
                                                <div class="text-center">
                                                    <i class="fas fa-info-circle"></i> La connexion au serveur ne peut pas être établie avec ce protocole.
                                                </div>
                                            </div>
                                        </div>
                                    <?php } elseif ($messages == "erreur") { ?>
                                        <div class="tab-pane fade in show" aria-expanded="false">
                                            <div class="info-page bg-info">
                                                <div class="text-center">
                                                    <i class="fas fa-info-circle"></i> Aucun message n'a été envoyé sur ce serveur !
                                                </div>
                                            </div>
                                        </div>

                                    <?php } else { ?>
                                        <div class="tab-pane fade in show" aria-expanded="false">
                                            <div class="alert alert-info">
                                                <div class="text-center">
                                                    <i class="fas fa-info-circle"></i> La connexion au serveur n'a pas pu être établie.
                                                </div>
                                            </div>
                                        </div>

                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <?php if (Permission::getInstance()->verifPerm("connect")) : ?>
                    <!-- Envoie du message -->
                    <form action="?action=sendChat" method="POST">
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="text" name="message" placeholder="Envoyez votre message..." max="100" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <select name="i" class="form-control">
                                        <?php foreach ($lectureJSON as $i => $serveur) : ?>
                                            <option value="<?= $i; ?>">
                                                <?= $serveur['nom']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-12 mt-3 text-center">
                                    <button class="btn btn-primary btn-block" type="submit" style="color: black">Envoyer</button>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php else : ?>
                    <div class="card-footer">
                        <h5 class="text-center">
                            Connectez-vous pour utiliser le chat : <br />
                            <a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-main mt-2">
                                <span class="glyphicon glyphicon-user"></span>Connexion
                            </a>
                        </h5>
                    </div>
                <?php endif; ?>
            </div>
            <?php endif ?>
        </div>
    </div>
    </div>
</section>
