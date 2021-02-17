<?php include('theme/' . $_Serveur_['General']['theme'] . '/config/configTheme.php');
?>

<!-- ATTENTION AUX DEVELOPPEURS DE THEME :
        -> Le système est concue pour qu'il n'y est qu'un seul FORM, et c'est celui de cette action ! Donc merci de ne pas créer d'autres form et de tout garder dans ce form avec cette action et en POST !
        -> Le fichier de traitement est configAdminTraitement.php il ne peux ni être renommer ni déplacé !
        -> Tout se fait en AJAX donc vous devez conservé le onClick="sendPost('configThemeAdmin');" sur le bouton d'envoie + ne pas mettre de balise <form> + conserver le <script>...</script> + conserver une div id="configThemeAdmin" qui doit englober tout les input de votre formulaire (sinon ils ne seront pas recupérés). N'hésitez pas à demander de l'aide sur le discord !
-->
<style id="themeEdition">
    .theme .nav-item>.nav-link {
        color: black !important;
    }

    .btn-danger {
        color: #fff;
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-success {
        color: #fff;
        background-color: #28a745;
        border-color: #28a745;
    }
</style>

<div class="row theme">
    <div class="col-md-9 col-xl-9 col-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Configuration du thème </h4>
            </div>

            <div class="card-body">

                <section>
                    <!-- Gestion des réseaux sociaux -->
                    <div class="row">
                        <div class="col-12" id="configThemeAdmin">

                            <ul class="nav nav-tabs mb-3" id="defaultTheme" role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link active" id="aboutEdition-tab" data-toggle="tab" href="#aboutEdition" role="tab" aria-controls="aboutEdition" aria-selected="true">About</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="newsEdition-tab" data-toggle="tab" href="#newsEdition" role="tab" aria-controls="newsEdition" aria-selected="false">News</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="staffEdition-tab" data-toggle="tab" href="#staffEdition" role="tab" aria-controls="staffEdition" aria-selected="false">Staff</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="footerEdition-tab" data-toggle="tab" href="#footerEdition" role="tab" aria-controls="footerEdition" aria-selected="false">Footer</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="otherEdition-tab" data-toggle="tab" href="#otherEdition" role="tab" aria-controls="otherEdition" aria-selected="false">Other</a>
                                </li>

                            </ul>

                            <div class="tab-content" id="defaultThemeContent">


                                <div class="tab-pane fade show active" id="aboutEdition" role="tabpanel" aria-labelledby="aboutEdition-tab">

                                    <div class="col-11 mx-auto my-2">

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

                                </div>

                                <div class="tab-pane fade mx-auto" id="newsEdition" role="tabpanel" aria-labelledby="newsEdition-tab">

                                    <div class="col-11 mx-auto my-2">

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

                                </div>


                                <div class="tab-pane fade mx-auto" id="staffEdition" role="tabpanel" aria-labelledby="staffEdition-tab">

                                    <div class="col-11 mx-auto my-2">

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

                                                <label class="control-label text-left">Nombre de membre du staff</label>
                                                <input type="number" class="form-control" name="staff-number" value="<?php echo $_Theme_['Staff']['number']; ?>">
                                                <span class="help-block">Pour actualiser les champs en dessous, merci d'appuyer sur Valider puis mettre les pseudonyme, tout apparaîtra automatiquement !</span>

                                            </div>

                                            <?php
                                            $staffnumber = $_Theme_['Staff']['number'];
                                            if ($staffnumber == null){
                                                $staffnumber = 0;
                                            }
                                            for ($numStaff = 1; $numStaff < $staffnumber + 1; $numStaff++) : ?>
                                                <div class="col-xs-6">
                                                    <label class="control-label text-left">Pseudo Minecraft</label>
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
                                </div>



                                <div class="tab-pane fade mx-auto" id="footerEdition" role="tabpanel" aria-labelledby="footerEdition-tab">

                                    <div class="col-11 mx-auto my-2">

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

                                </div>



                                <div class="tab-pane fade mx-auto" id="otherEdition" role="tabpanel" aria-labelledby="otherEdition-tab">


                                    <div class="col-11 mx-auto my-2">

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


                                </div>
                            </div>
                        </div>

                </section>

            </div>

            <div class="card-footer">
                <div class="form-group text-center">
                    <input type="submit" onClick="sendPost('configThemeAdmin'); document.location.reload();" class="btn btn-success" value="Sauvegarder">
                </div>

                <script>
                    initPost("configThemeAdmin", "admin.php?action=configTheme");
                </script>
            </div>

        </div>
    </div>
</div>




<script>
    function createNewReseau() {
        var ico = get('new-s-icone');
        var link = get('new-s-link');
        var msg = get('new-s-message');

        if (isset(ico.value) && ico.value.replace(" ", "") != "" && isset(link.value) && link.value.replace(" ", "") !=
            "" && isset(msg.value) && msg.value.replace(" ", "") != "") {
            var ht =
                '<div class="form-row jumbotron py-1" data-reseau>' +
                '<h5 class="col-12 my-1">Réseau <small> <div class="badge badge-warning">Non sauvegardé si pas cliqué sur sauvegarder !</div></small></h5>' +
                '<div class="col-12">' +
                '<label class="control-label">Icone du réseau</label>' +
                '<input type="text" data-type="icon" class="form-control" id="" placeholder=\'<i class="fab fa-discord"></i>\' value="' +
                ico.value.replace(/"/g, '\'') + '">' +
                '<small>Disponible sur : <a href="https://fontawesome.com/icons/"> https://fontawesome.com/icons/</a></small>' +
                '</div>' +

                '<div class="col-12">' +
                '<label class="control-label">Lien vers le réseau</label>' +
                '<input type="text" id="" class="form-control" data-type="link" value="' + link.value.replace(/"/g, '\'') + '">' +
                '</div>' +

                '<div class="col-12">' +
                '<label class="control-label">Message à mettre à côté</label>' +
                '<input type="text" class="form-control" id="" data-type="message" placeholder="Rejoingnez-nous sur Discord !" value="' +
                msg.value.replace(/"/g, '\'') + '">' +
                '</div>' +

                '<div class="col-4 my-4">' +
                '<button class="btn btn-danger form-control" onclick="this.parentElement.parentElement.parentElement.removeChild(this.parentElement.parentElement); genJsonReseau(); sendPost(\'configThemeAdmin\');">Supprimer</button>' +
                '</div>' +

                '</div>'

            get('all-reseau').insertAdjacentHTML("beforeend", ht);
            ico.value = msg.value = link.value = null
            delete ico;
            delete msg;
            delete value;
        } else {
            notif("warning", "Erreur", "Formulaire incomplet");
        }

    }


    $("#aboutTheme").val((i, v) => v.replace(/\s{2,}/g, ''));
</script>
