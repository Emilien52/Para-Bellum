<?php include('theme/' . $_Serveur_['General']['theme'] . '/config/configTheme.php');
?>
<div class="col-xs-12 text-center">
    <div class="panel panel-default cmw-panel">
        <div class="panel-heading cmw-panel-header">
            <h3 class="panel-title"><strong>Configuration du thème</strong></h3>
        </div>
        <div class="panel-body">
            <form method="POST" action="?&action=configTheme">

                <!-- NAVIGATION -->
                <h3 class="text-left">Liste des sections modifiable:</h3>
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a data-toggle="tab" href="#pills-about">About</a></li>
                    <li><a data-toggle="tab" href="#pills-news">News</a></li>
                    <li><a data-toggle="tab" href="#pills-staff">Staff</a></li>
                    <li><a data-toggle="tab" href="#pills-footer">Footer</a></li>
                    <li><a data-toggle="tab" href="#pills-other">Other</a></li>
                </ul>

                <!-- CONTENT -->
                <div class="tab-content">

                    <!-- ABOUT SECTION -->
                    <div class="tab-pane fade in active" id="pills-about">

                        <h4 class="text-left"><b>Section à Propos</b></h4>
                        <hr />
                        <div class="row">
                            <div class="col-xs-4">
                                <label class="control-label text-left">Titre</label>
                                <input type="text" class="form-control" name="about-main-title" value="<?php echo $_Theme_['About']['main-title']; ?>">
                            </div>
                            <div class="col-xs-8">
                                <label class="control-label text-left">Sous-titre</label>
                                <input type="text" class="form-control" name="about-desc-top" value="<?php echo $_Theme_['About']['desc-top']; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <br />
                            <h5 class="text-left">Icone 1 :</h5>
                            <div class="container">
                                <div class="col-xs-3">
                                    <label class="control-label text-left">Nom de l'icone :</label>
                                    <input type="text" class="form-control" name="about-icon1" value="<?php echo $_Theme_['About']['icon1']; ?>">
                                    <span class="help-block">Le nom de l'icone doît être dans le catalogue de FontAwesome<br /><a href="https://fontawesome.com/icons?d=gallery"><b>Lien du Site ici !</b></a> </span>
                                </div>
                                <div class="col-xs-3">
                                    <label class="control-label text-left">Titre de l'icone :</label>
                                    <input type="text" class="form-control" name="about-title1" value="<?php echo $_Theme_['About']['title1']; ?>">
                                </div>
                                <div class="col-xs-6">
                                    <label class="control-label text-left">Description de l'icone :</label>
                                    <input type="text" class="form-control" name="about-desc1" value="<?php echo $_Theme_['About']['desc1']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <br />
                            <h5 class="text-left">Icone 2 :</h5>
                            <div class="container">
                                <div class="col-xs-3">
                                    <label class="control-label text-left">Nom de l'icone :</label>
                                    <input type="text" class="form-control" name="about-icon2" value="<?php echo $_Theme_['About']['icon2']; ?>">
                                    <span class="help-block">Le nom de l'icone doît être dans le catalogue de FontAwesome<br /><a href="https://fontawesome.com/icons?d=gallery"><b>Lien du Site ici !</b></a> </span>
                                </div>
                                <div class="col-xs-3">
                                    <label class="control-label text-left">Titre de l'icone :</label>
                                    <input type="text" class="form-control" name="about-title2" value="<?php echo $_Theme_['About']['title2']; ?>">
                                </div>
                                <div class="col-xs-6">
                                    <label class="control-label text-left">Description de l'icone :</label>
                                    <input type="text" class="form-control" name="about-desc2" value="<?php echo $_Theme_['About']['desc2']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <br />
                            <h5 class="text-left">Icone 3 :</h5>
                            <div class="container">
                                <div class="col-xs-3">
                                    <label class="control-label text-left">Nom de l'icone :</label>
                                    <input type="text" class="form-control" name="about-icon3" value="<?php echo $_Theme_['About']['icon3']; ?>">
                                    <span class="help-block">Le nom de l'icone doît être dans le catalogue de FontAwesome<br /><a href="https://fontawesome.com/icons?d=gallery"><b>Lien du Site ici !</b></a> </span>
                                </div>
                                <div class="col-xs-3">
                                    <label class="control-label text-left">Titre de l'icone :</label>
                                    <input type="text" class="form-control" name="about-title3" value="<?php echo $_Theme_['About']['title3']; ?>">
                                </div>
                                <div class="col-xs-6">
                                    <label class="control-label text-left">Description de l'icone :</label>
                                    <input type="text" class="form-control" name="about-desc3" value="<?php echo $_Theme_['About']['desc3']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <br />
                            <div class="container">
                                <div class="col-xs-12">
                                    <label class="control-label text-left">Commentaire en bas de la section About</label>
                                    <input type="text" class="form-control" name="about-desc-bottom" value="<?php echo $_Theme_['About']['desc-bottom']; ?>">
                                </div>
                            </div>
                        </div>

                    </div>


                    <!-- NEWS SECTION -->
                    <div class="tab-pane fade" id="pills-news">

                        <h4 class="text-left"><b>Section News</b></h4>
                        <hr />

                        <div class="row">
                            <div class="col-xs-4">
                                <label class="control-label text-left">Titre</label>
                                <input type="text" class="form-control" name="news-main-title" value="<?php echo $_Theme_['News']['main-title']; ?>">
                            </div>
                            <div class="col-xs-8">
                                <label class="control-label text-left">Sous-titre</label>
                                <input type="text" class="form-control" name="news-desc-top" value="<?php echo $_Theme_['News']['desc-top']; ?>">
                            </div>
                        </div>

                    </div>





                    <!-- STAFF SECTION -->
                    <div class="tab-pane fade" id="pills-staff">
                        <h4 class="text-left"><b>Section Staff</b></h4>
                        <hr />
                        <div class="row">
                            <div class="col-xs-4">
                                <label class="control-label text-left">Titre</label>
                                <input type="text" class="form-control" name="staff-main-title" value="<?php echo $_Theme_['Staff']['main-title']; ?>">
                            </div>
                            <div class="col-xs-8">
                                <label class="control-label text-left">Sous-titre</label>
                                <input type="text" class="form-control" name="staff-desc-top" value="<?php echo $_Theme_['Staff']['desc-top']; ?>">
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <br />
                                    <label class="control-label text-left">Nombre de membre du staff</label>
                                    <input type="number" class="form-control" name="staff-number" value="<?php echo $_Theme_['Staff']['number']; ?>">
                                    <span class="help-block">Pour actualiser les champs en dessous, merci d'appuyer sur Valider puis mettre les pseudonyme, tout apparaîtra automatiquement !</span>
                                </div>
                            </div>

                            <?php
                            for ($numStaff = 1; $numStaff < $_Theme_['Staff']['number'] + 1; $numStaff++) : ?>
                                <div class="col-xs-6">
                                    <label class="control-label text-left">Psuedo Minecraft</label>
                                    <input type="text" class="form-control" name="staff-name<?= $numStaff ?>" value="<?php echo $_Theme_['Staff']['name' . $numStaff]; ?>">
                                </div>
                                <div class="col-xs-6">
                                    <label class="control-label text-left">Grade</label>
                                    <input type="text" class="form-control" name="staff-grade<?= $numStaff ?>" value="<?php echo $_Theme_['Staff']['grade' . $numStaff]; ?>">
                                </div>
                                <br />
                            <?php endfor; ?>
                        </div>
                    </div>


                    <!-- FOOTER SECTION -->
                    <div class="tab-pane fade" id="pills-footer">

                        <h4 class="text-left"><b>Section Footer</b></h4>
                        <hr />
                        <div class="row">

                            <h5 class="text-left">Icone 1 :</h5>
                            <div class="container">
                                <div class="col-xs-4">
                                    <label class="control-label text-left">Nom de l'icone :</label>
                                    <input type="text" class="form-control" name="footer-icon1" value="<?php echo $_Theme_['Footer']['icon1']; ?>">
                                    <span class="help-block">Le nom de l'icone doît être dans le catalogue de FontAwesome<br /><a href="https://fontawesome.com/icons?d=gallery"><b>Lien du Site ici !</b></a> </span>
                                </div>
                                <div class="col-xs-8">
                                    <label class="control-label text-left">Lien de redirection :</label>
                                    <input type="text" class="form-control" name="footer-link-icon1" value="<?php echo $_Theme_['Footer']['link-icon1']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <br />
                            <h5 class="text-left">Icone 2 :</h5>
                            <div class="container">
                                <div class="col-xs-4">
                                    <label class="control-label text-left">Nom de l'icone :</label>
                                    <input type="text" class="form-control" name="footer-icon2" value="<?php echo $_Theme_['Footer']['icon2']; ?>">
                                    <span class="help-block">Le nom de l'icone doît être dans le catalogue de FontAwesome<br /><a href="https://fontawesome.com/icons?d=gallery"><b>Lien du Site ici !</b></a> </span>
                                </div>
                                <div class="col-xs-8">
                                    <label class="control-label text-left">Lien de redirection :</label>
                                    <input type="text" class="form-control" name="footer-link-icon1" value="<?php echo $_Theme_['Footer']['link-icon2']; ?>">
                                    <span class="help-block">Inscrivez le lien où le bouton nous redirige lorsqu'on clique dessus</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <br />
                            <h5 class="text-left">Icone 3 :</h5>
                            <div class="container">
                                <div class="col-xs-4">
                                    <label class="control-label text-left">Nom de l'icone :</label>
                                    <input type="text" class="form-control" name="footer-icon3" value="<?php echo $_Theme_['Footer']['icon3']; ?>">
                                    <span class="help-block">Le nom de l'icone doît être dans le catalogue de FontAwesome<br /><a href="https://fontawesome.com/icons?d=gallery"><b>Lien du Site ici !</b></a> </span>
                                </div>
                                <div class="col-xs-8">
                                    <label class="control-label text-left">Lien de redirection :</label>
                                    <input type="text" class="form-control" name="footer-link-icon3" value="<?php echo $_Theme_['Footer']['link-icon3']; ?>">
                                    <span class="help-block">Inscrivez le lien où le bouton nous redirige lorsqu'on clique dessus</span>
                                </div>
                            </div>
                        </div>

                    </div>


                    <!-- OTHER SECTION -->
                    <div class="tab-pane fade" id="pills-other">

                        <h4 class="text-left"><b>Section Couleurs</b></h4>
                        <hr />
                        <div class="row">

                            <h5 class="text-left">Couleur principale :</h5>
                            <div class="container">
                                <div class="col-xs-4">
                                    <label class="control-label text-left">Couleur actuelle</label>
                                    <input type="text" class="form-control" name="other-main-color-before" value="<?php echo (empty($_Theme_['Other']['main-color'])) ? '#d82c2e' : $_Theme_['Other']['main-color']; ?>" disabled>
                                </div>
                                <div class="col-xs-8">
                                    <label class="control-label text-left">Nouvelle couleur</label>
                                    <input type="color" class="form-control" name="other-main-color" value="<?php echo (empty($_Theme_['Other']['main-color'])) ? '#d82c2e' : $_Theme_['Other']['main-color']; ?>">
                                    <span>Couleur par défaut : <code>#d82c2e</code></span>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="form-group text-center" style="margin-top: 2em">
                        <input type="submit" class="btn btn-success">
                    </div>

                </div>

            </form>
        </div>
    </div>
</div>
