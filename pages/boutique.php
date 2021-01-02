<style>
blockcote{color: #000;}.btn-parabellumW:hover i { color: var(--color-main) }
</style>
<section class="layout" id="white">
	<div class="container">
		<h1 class="titre text-uppercase"><span class="fa fa-shopping-cart"></span> Boutique</h1>
	</div>
</section>
<section class="layout" id="page">
	<div class="container text-white">
		<div class="info-container">
			<h3><strong><span class="fas fa-info-circle"></span> Comment ça marche ?</strong></h3>
			<p>
				La boutique permet d'acheter du contenu In-Game depuis le site grâce à de l'argent réel, cela sert à payer l'hébergement du serveur. <br>
				La monnaie virtuelle utilisée sur la boutique est le "<?=$_Serveur_['General']['moneyName'];?>", vous pouvez obtenir des <?=$_Serveur_['General']['moneyName'];?> en échange de dons sur <a href="/?&page=token"> cette page</a>.
			</p>
		</div>
		<br>
		<?php if(!isset($_Joueur_)) { ?>
			<h4>Veuillez vous connecter pour accéder à la boutique:</h4>
			<center>
				<a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-warning btn-lg" ><span class="glyphicon glyphicon-user"></span> Connexion</a>
			</center>
		<?php } else { ?>
			<div class="shop-basket">
				<h4>
					Bonjour <?php echo $_Joueur_['pseudo']; ?>, vous avez <strong><?php if(isset($_Joueur_['tokens'])) echo $_Joueur_['tokens'] . ' <i class="fas fa-gem"></i>'; ?></strong> 
					<a style="float:right;" class="btn btn-parabellum" href="?page=panier">Votre panier contient <?php echo $_Panier_->compterArticle().($_Panier_->compterArticle()>1 ? ' articles' : ' article') ?> </a>
				</h4>
			</div>
			
			</br>
			</br>
			<div class="tabbable white-container">
				<ul class="nav nav-tabs" style="margin-bottom:20px;">					
					<?php if (isset($categories)) : ?>
						<!-- Affichage noms catégories -->
						<?php for ($j = 0; $j < count($categories); $j++) : ?>
							<li class="nav-item">
								<a class="btn btn-parabellumW" href="#categorie-<?= $j ?>" data-toggle="tab" class="nav-link <?php if($j == 0) echo 'active'; ?>">
									<?php $categories[$j]['titre'] = str_replace('_', ' ', $categories[$j]['titre']); echo $categories[$j]['titre']; ?>
								</a>
							</li>
						<?php endfor; ?>
					<?php else : //Si il n'y a aucune catégorie on affiche ce bouton ?>
						<li class="nav-item">
							<div href="#categorie-none" class="btn btn-parabellumW nav-link active" data-toggle="tab">
								<i class="fas fa-exclamation-triangle"></i> <br> Aucune Catégorie !
							</div>
						</li>
					<?php endif; ?>
				</ul>
				<div class="tab-content">
				<!-- Affichage de la catégorie -->
					<?php for ($j = 0; $j < count($categories); $j++) : //Pour chaque catégorie on créé son panel ?>
						<div id="categorie-<?= $j ?>" class="tab-pane fade <?php if($j==0) echo 'in active show';?>" <?php if($j == 0) { echo 'aria-expanded="true"'; } else echo 'aria-expanded="false"'; ?>>
							<?php $categories[$j]['titre'] = str_replace('_', ' ', $categories[$j]['titre']); //Petit hack pour transformer les _ en espace ?>
							<div class="panel-body">
								<?php if($categories[$j]['message'] != "") { //Si il y a une description de categorie bah faut l'afficher ^^ ?>
									<p>
										<div class="alert alert-shop"><?= $categories[$j]['message'] ?></div>
									</p>
									<br>
								<?php } ?>
								<div class="row">
								<?php
									foreach($categories as $key => $value){ //Pour chaque categorie on initialise le compteur du nombre d'offres à 0
										$categories[$key]['offres'] == 0;
									}
									for($i = 1; $i <= count($offresTableau); $i++){ //On parcourt toutes les offres
										if($offresTableau[$i]['categorie'] == $categories[$j]['id']){ //On ne sélectionne que celles qui ont pour ID de catégorie celle qu'on est en train de gérer
											echo '
											<div class="col-sm-12 col-lg-4 panel panel-default">
												<div class="offer" id="offer">
													<div class="panel-body">
															<h3 style="padding: 20px; margin: 0px;">'. $offresTableau[$i]['nom'] .'</h3>
														</div>
														';
														if(isset($_Joueur_)) {
															echo '<a data-toggle="tooltip" data-placement="bottom" title="Clic pour + d\'infos" onclick="showOffre(' .$offresTableau[$i]['id']. ')" class="btn btn-offer btn-block"><i class="fa fa-cart-arrow-down"></i> Voir ce produit</a>';
														} else { 
															echo'<a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-warning btn-block" ><span class="glyphicon glyphicon-user"></span> Se connecter</a>';
														} ?>
														
														<?php if (Permission::getInstance()->verifPerm("connect")) : ?>
															<?php if (isset($offresTableau[$i]['buy'])) { ?>
																<a href="#" class="btn btn-offer btn-block disabled" disabled>Vous devez d'abord acheter: <?php foreach($offresTableau[$i]['buy'] as $value) { echo $offresByGet[$value]; } ?></a>
															<?php } else if (isset($offresTableau[$i]['maxbuy'])) { ?>
																<a href="#" class="btn btn-offer btn-block disabled" disabled>Vous avez dépassé le nombre d'achat<br>maximal de cette offre</a>
															<?php } else if ($offresTableau[$i]['nbre_vente'] == 0) { ?>
																<a href="#" class="btn btn-offer btn-block disabled" disabled>Rupture de stock</a>
															<?php } ?>
														<?php else : ?>
															<a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-warning btn-block">
																<span class="glyphicon glyphicon-user"></span> Se connecter
															</a>
														<?php endif; ?>
											<?php		
												echo '<div class="price">' .$offresTableau[$i]['prix']. ' <i class="fas fa-gem"></i></div>
												</div>
											</div>';
											$categories[$j]['offres']++;
										}
									}
								?>
								</div>
								<?php 
								if($categories[$j]['offres'] == 0){ //Si aucune offre on affiche un message
									echo '<div class="alert alert-dismissible alert-primary">
										<center id="alert-white">Oh zut ! '.$categories[$key]['titre'].' est encore vide, ré-essayez plus tard !</center>
									</div>';
								}
								?>
							</div>
						</div>
					<?php endfor; ?>
				</div>
			</div>
		<?php } ?>
	</div>	
	<script>
		let categories = <?= json_encode($categories) ?>;
		let offres = <?= json_encode($offresTableau) ?>;
	
		function showOffre(id){
			if(offres[id] != null){
				let desc = offres[id].description;
				if(desc == ""){ desc="Cette offre est un don sans contrepartie..."; }
				let name = offres[id].nom;
				let prix = offres[id].prix;
				
				document.getElementById("modalOffre-Nom").innerHTML="<b>Achat de : "+name+"</b>";
				document.getElementById("modalOffre-Description").innerHTML=desc;
				document.getElementById("modalOffre-Id").value=id;
				
				let formQte = document.getElementById("modalOffre-Qte");
				let submit = document.getElementById("modalOffre-Submit");
				
				if(offres[id].buy){
					submit.innerText = "Vous devez d'abord acheter : "+offres[offres[id].buy].nom;
					submit.disabled = true;
					formQte.style.display = "none";
				} else if(offres[id].maxbuy){
					submit.innerText = "Vous avez dépassé le nombre d'achat maximum de cette offre";
					submit.disabled = true;
					formQte.style.display = "none";
				} else if(offres[id].nbre_vente == 0){
					submit.innerText = "Rupture de stock";
					submit.disabled = true;
					formQte.style.display = "none";
				} else {
					submit.innerHTML = "<i class='fa fa-cart-arrow-down'></i> Ajouter au panier";
					submit.disabled = false;
					formQte.style.display = "flex";
				}				
				
				$('#modalOffre').modal('show')
			}
		}
	</script>
		
	
	<?php 	
		//foreach ($offresTableau as $offre) {
	?>
		<div class="modal fade" id="modalOffre" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<h4 class="modal-title" id="modalOffre-Nom"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			  </div>
			  <div class="modal-body">
					<p>
						<br>
						<b>Description de l'offre :</b>
						<blockquote>
						<span id="modalOffre-Description"></span>
						</blockquote>
					</p>
			  </div>
			  <div class="modal-footer">
				<?php
					//if(($enLigne AND $infosCategories['connection']) OR !$infosCategories['connection']) { /!\ OBSOLETE
					if(true==true){
				?>
					<form action="index.php" method="GET" class="form-inline" style="width:100%">
						<input type="hidden" name="action" value="addOffrePanier"/>
						<input type="hidden" id="modalOffre-Id" name="offre" value=""/>
						<div class="form-row" id="modalOffre-Qte" style="width:100%;">
							<div class="col-sm-6 col-md-3">
								<h4 class="pt-2">Quantité : </h4>
							</div>
							<div class="col-sm-6 col-md-9">
								<input type="number" class="form-control mb-1 mr-sm-1" style="width:100%" id="quantite" name="quantite" value="1" />
							</div>
						</div>
						<button type="submit" id="modalOffre-Submit" style="display:block" class="btn btn-block btn-success mb-2">Ajouter au panier</button>
					</form>
				<?php } else{ ?>
					<p class="text-body">Connectez-vous sur le serveur voulu...</p>
				<?php }  ?>
			  </div><button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
			</div>
		  </div>
		</div>
	<?php
		//}
	?>

		
	</div>
</section>
