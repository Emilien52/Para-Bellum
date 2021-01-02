<style>
.nav-link {
    transition-duration: .1s;    
}
.nav-link[aria-expanded="true"] {
    background: var(--color-main);
    color: #fff !important;
}
.vote-container {
    border: 2px solid var(--color-main);
    margin-left: 1px;
    border-radius: 0 15px 15px 15px;
    padding: 10px;
}
.vote-container {
    background: var(--color-main);
}
.collapsing {
    transition-duration: .0001s;
}
</style>
<section class="layout" id="white">
	<div class="container">
		<h1 class="titre text-uppercase"><span class="fas fa-calendar-alt"></span> Voter</h1>
	</div>
</section>
<section class="layout" id="page">
    <div class="container-fluid col-md-9 col-lg-9 col-sm-10">
        <!-- Alerts -->
        <div class="alertSection mb-3">
            <?php if (isset($_GET['success'])) :
                if ($_GET['success'] != 'recupTemp') : ?>
                    <div class="alert alert-success alert-dismissible fade show text-shadow-none" role="alert">
                        Votre récompense arrive, si vous n'avez pas vu de fenêtre s'ouvrir pour voter, la fenêtre à dû s'ouvrir derrière votre navigateur, validez le vote et <strong class="color-red">profitez de votre récompense In-Game</strong> !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span class="color-red" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php else : ?>
                    <div class="alert alert-success alert-dismissible fade show text-shadow-none" role="alert">
                        La récompense séléctionnée arrive, <strong class="color-red">profitez de cette dernière In-Game !</strong><br>
                        Votre(vos) récompense(s) arrive(nt), profitez de votre(vos) récompense(s) In-Game !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span class="color-red" aria-hidden="true">&times;</span>
                        </button>
                    </div>
            <?php endif;
            endif; ?>
        </div>
        
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title text-center"><?php echo $_Serveur_['General']['name']; ?> a besoin de vous !</h3>
			</div>
			<div class="panel-body">
				<p class="text-center">
					<strong>Voter pour le serveur permet d'améliorer son référencement ! Les votes sont récompensés par des items In-Game.</strong>
				</p>
			</div>
		</div>
					
		

        <!-- Gestion des informations de vote -->
        <div>
            <?php
            if (Permission::getInstance()->verifPerm("connect") and isset($_GET['player']) and $_Joueur_['pseudo'] == $_GET['player']) {  ?>
                    <!-- Gestion des Récompenses -->
                    <div class="alert alert-main w-80 mx-auto" id="disprecompList" style="display:none;">
                        
                        <h4 class="alert-heading h4">
                            Réception de récompense(s) !
                        </h4>
                        <hr>

                        <ul id="recompList-DISABLED" class="list-unstyled container">
                        </ul>
                        
                    </div>
            <?php } ?>
        </div>

		<div class="white-container">
			<div class="row">
				<?php if (!isset($_GET['player'])) { ?>
				
					<!-- Demande du Pseudonyme -->					
					<div class="col-sm-12 text-center">
						<h4 class="panel-title text-center color-red">Veuillez rentrer votre pseudo exact In-Game :</h4>
						<form id="forme-vote" role="form" method="GET" action="index.php">
							<div style="margin-right:20%;margin-left:20%">
								<input type="text" style="display:none;" name="page" value="voter">
								<div class="form-row">
									<div class="col-6">
										<input type="text" id="vote-pseudo" class="form-control" name="player" placeholder="Pseudo" value="<?= (Permission::getInstance()->verifPerm("connect")) ? $_Joueur_['pseudo'] : '' ?>" required>
									</div>
									<div class="col-6">
										<button class="btn btn-block btn-success" type="submit">Suivant !</button>
									</div>
								</div>
							</div>
						</form>
					</div>
					
				<?php } else { ?>

					<!-- Affichage des serveurs de jeu -->
					<div id="voteContainer" class="col-sm-12 text-white">
						<div class="card" style="border:0">
							<div class="tabbable">
								<ul class="nav nav-tabs" style="margin:0">
									<?php
									if (!isset($jsonCon) or empty($jsonCon))
										echo '
										<div class="mx-auto">
										<div class="alert alert-danger text-center">Veuillez relier votre serveur à votre site avec JsonAPI depuis le panel pour avoir les liens de vote !</div>
										</div>';
									
									$first=true;
									foreach($lectureJSON as $serveur) { ?>

										<li class="nav-item">
											<a href="#voter-<?= $serveur['id']; ?>" data-toggle="collapse" aria-expanded="<?php if($first==true){echo "true";}else{echo "false";} ?>" data-target="#voter<?= $serveur['id']; ?>" aria-controls="#voter<?= $serveur['id']; ?>" class="nav-link color-red<?php if ($first==true) echo ' active'; ?>"><?= $serveur['nom']; ?></a>
										</li>

									<?php $first=false; } ?>
								</ul>
							</div>
							<?php
								require("modele/vote.class.php");
								$pseudo = htmlspecialchars($_GET['player']);							
								
								if(Permission::getInstance()->verifPerm("connect") AND  isset($_GET['player']) AND $_Joueur_['pseudo'] == $_GET['player'] ) {
									echo '<script>isConnect = true;</script>';
								}

								 $first=true; foreach($lectureJSON as $serveur) { ?>
									<!-- Affichage des sites de vote de la catégorie -->
									<div id="voter<?php echo $serveur['id']; ?>" aria-labelledby="voter-<?php echo $serveur['id']; ?>" data-parent="#voteContainer" class="vote-container collapse fade<?php if($first==true) echo ' show';?>">
										<div class="info-page">
											<div class="info-content">
												Bienvenue dans la catégorie de vote pour le serveur : <strong><?= $serveur['nom']; ?></strong>
											</div>
										</div><hr style="border-color:#fff">
										<h5 class="title-vote-listing text-center">
											Liste des sites de vote <div class="vote-line"></div>
										</h5>
										<?php 
										$req_vote->execute(array('serveur' => $serveur['id']));
										if($req_vote->rowCount() != 0){
											while($allvote = $req_vote->fetch(PDO::FETCH_ASSOC)) {
												 $vote = new vote($bddConnection, $pseudo, $allvote['id']);

												  ?>

												 <button type="button" id="votebtn-<?php echo $allvote['id']; ?>" ></button>
												 <script>initVoteBouton(document.getElementById('votebtn-<?php echo $allvote['id']; ?>'), '<?php echo $pseudo; ?>', <?php echo $allvote['id']; ?>, <?php echo $vote->getLastVoteTimeMili(); ?>, <?php echo $vote->getTimeVoteTimeMili(); ?>, '<?php echo $vote->getUrl(); ?>', '<?php echo $vote->getTitre(); ?>');</script>
										<?php }
										} else { ?>
											<p class="text-center">Aucun site de vote n'a été configuré pour ce serveur.</p>
										<?php } ?>
									 </div>

								<?php $first=false; } ?>
						</div>
					</div>
					<script><?php 
						foreach($topRecompense as $key => $value) {
							echo "topRec.set(".$key.",JSON.parse('".$value."'));";
						}
					?></script>
				<?php } ?>
			</div>
		</div>
		
		<div class="white-container mt-3">
			<div class="row">
				<div class="col-sm-12">
					<!-- Affichage des informations du joueur -->
					<div class="card">
						<div class="card-header bg-parabellum">
							<h4>Informations</h4>
							<div class="card-body">
								<h5>Bonjour, <?= $pseudo ?></h5>

								<h6>Merci d'avance pour votre vote !</h6>

								<?php  if(isset($dateRec) && $dateRec['valueType'] != 0 && $dateRec['etat'] != 0)
								{ 
								   
									?><h6> Les votes se rénitialiseront le <?= str_replace(array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'), array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'), date('l', $dateRec['etat'])).date(" j \à G\hi", $dateRec['etat']); ?>.</h6>
								<?php } ?>
								
								
								<?php if(isset($_Serveur_['vote']['oldDisplay'])) {
									$a = 1; ?>
									<br/>
									<h6>Liste des précédents meilleurs voteurs:</h6>
									<table class="table table-dark table-striped table-hover table-sm">
										<thead>
											<tr>
												<th><h6>#</h6></th>
												<th><h6>Pseudo</h6></th>
												<th><h6>Votes</h6></th>
											</tr>
										</thead>
										<body>
										<?php while($oldVote = $oldvote_req->fetch(PDO::FETCH_ASSOC))
										{ if($a < $_Serveur_['vote']['oldDisplay']) { ?>
											<tr>
												<td><h6><?php echo $a; ?></h6></td>
												<td><h6><?php echo $oldVote['pseudo']; ?></h6></td>
												<td><h6><?php echo $oldVote['nbre_votes']; ?></h6></td>
											</tr>

										<?php $a++; } else { break; } } 
										?>
										</body>
									</table>
								<?php } ?>


							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

    </div>
	
	<!-- Top vote -->
	<h3 class="header-bloc">Top voteurs</h3>
		<div class="corp-bloc">
			<table class="table table-hover" id="baltop">
				<!-- theme/default/assets/js/voteControleur.js::updateBaltop -->
			</table>
		</div>
	
</section>
