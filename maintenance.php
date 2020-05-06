<?php
include('controleur/maintenance.php');

if($maintenance[$i]['maintenanceEtat'] == 0){
setTempMess("<script> $( document ).ready(function() { Snarl.addNotification({ title: '', text: 'La maintenance n\'est pas activée !', icon: '<span class=\'glyphicon glyphicon-cog\'></span>'});});</script>");
header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Maintenance <?php echo $_Serveur_['General']['name']; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/ionicons.min.css">
    <link rel="stylesheet" href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/animate.css">
    <link rel="stylesheet" href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/hover.min.css">
    <link rel="stylesheet" href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/custom.css">
    <link rel="stylesheet" href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/maintenance.css">
</head>
<body>
	<div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="card" style="border:0px;">
                    <h3 class="card-header text-center"><i class="fa fa-cog fa-spin"></i> Maintenance</h3>
                    <hr>
                    <div class="card-body text-center text-muted">
                        <h5 class="card-title"><?php echo $_Serveur_['General']['name']; ?> reviens très bientôt !</h5>
                        <br>
                        <h6 class="card-subtitle text-muted">
                            <?php echo $donnees['maintenanceMsg']; ?>
                        </h6>
                    </div>
                    <hr><?php if($_Joueur_['rang'] != 1 AND $_PGrades_['PermsPanel']['access'] == false)
                    { ?>
                    <div class="card-footer text-muted" style="border:0px;">
                        <a class="btn btn-block btn-parabellum" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Connexion administrateur</a>
                    </div>
                </div>
                <div class="collapse" id="collapseExample"><form method="post" action="?action=connection">
                    <div class="card card-body text-white bg-dark mb-3">
                        <div class="col-auto">
                        	<h4><?php echo $donnees['maintenanceMsgAdmin']; ?></h4>
                            <div class="form-group">
                                <label class="control-label">Votre pseudonyme</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon" style="border:0px;"><i class="fa fa-user"></i></div>
                                        <input type="text" class="form-control" name="pseudo" id="PSEUDO" placeholder="Pseudonyme" style="border:0px;">
                                    </div>
                                </div>
                                <label class="control-label">Votre mot de passe</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon" style="border:0px;"><i class="fa fa-lock"></i></div>
                                        <input type="password" name="mdp" class="form-control" id="MDP" placeholder="Mot de passe" style="border:0px;">
                                    </div>
                                </div>
                                <div class="form-group">
                                	<button class="btn btn-lg btn-parabellum btn-block" type="submit"> Connexion</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form></div><?php 
                 }
                 else
                 {
                 	?><div class="card-footer text-muted" style="border: 0px;">
                 		<a class="btn btn-block btn-parabellum" href="index.php">Accéder au site</a>
                 	</div><?php 
                 }
                 ?>
            </div>
        </div>
    </div>
	<div class="panel panel-primary" style="margin: 0 auto;max-width: 700px;margin-top: 80px;border-radius: 0px;">
		<div class="panel-body">
		<div class="footer-copyright" style="font-family: Minecraftia;font-weight: 200;text-align: center;font-size: 12px;">
				<?php include "include/version.php"; ?>
				Site web généré via le CMS <a href="https://craftmywebsite.fr/" target="_blank">CraftMyWebsite<a/> avec le thème <a href="#">X développé par Oxykis</a>, tous droits réservés<br/>
			</div>
		</div>
	</div>
	<script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/jquery.min.js"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.2/js/all.js"></script>
    <script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/popper.min.js"></script>
    <script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/bootstrap.min.js"></script>
    <script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/wow.min.js"></script>
    <script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/custom.js"></script>
    <script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/snarl.min.js"></script>
</body>
</html>