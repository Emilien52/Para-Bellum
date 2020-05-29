<style>
blockcote{
color: #000;
}
</style>
<section class="layout" id="white">
		<div class="container">
			<h1 class="titre text-uppercase"><span class="fa fa-shopping-cart"></span> Boutique</h1>
		</div>
</section>
<section class="layout" id="page">
<div class="container">
	<div class="info-container">
		<h3><strong><span class="fas fa-info-circle"></span> Comment ça marche ?</strong></h3>
		<p>
			La boutique permet d'acheter du contenu In-Game depuis le site grâce à de l'argent réel, cela sert à payer l'hébergement du serveur.
			La monnaie virtuelle utilisée sur la boutique est le "Jeton", vous pouvez obtenir des jetons en échange de dons <a href="?&page=token" style="color: #8defff;">sur cette page</a>
		</p>
	</div>
	<br>
	<?php if(isset($_Joueur_)) { ?>
		<div class="shop-basket">
			<h4>
				Bonjour <?php echo $_Joueur_['pseudo']; ?>, vous avez <strong><?php if(isset($_Joueur_['tokens'])) echo $_Joueur_['tokens'] . ' <i class="fas fa-gem"></i>'; ?></strong> 
				<a style="float:right;" class="btn btn-parabellum" href="?page=panier">Votre panier contient <?php echo $_Panier_->compterArticle().($_Panier_->compterArticle()>1 ? ' articles' : ' article') ?> </a>
			</h4>
		</div>
			<?php } else { ?>
	<h4>Veuillez vous connecter pour accéder à la boutique:</h4>
	<a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-warning btn-lg" ><span class="glyphicon glyphicon-user"></span> Connexion</a>
	<?php } ?>
	</br>
	</br>
		<div class="tabbable white-container">
			<ul class="nav nav-tabs" style="margin-bottom:20px;">
			<?php
			$j = 0;
			while($j < count($categories))
			{
			$categories[$j]['titre'] = str_replace(' ', '_', $categories[$j]['titre']);
			?>
					<li class="nav-item">
						<a class="btn btn-parabellumW" href="#categorie-<?php echo $j; ?>" data-toggle="tab" class="nav-link <?php if($j == 0) echo 'active'; ?>"><?php $categories[$j]['titre'] = str_replace('_', ' ', $categories[$j]['titre']); echo $categories[$j]['titre']; ?></a>
					</li>
			<?php $j++; } ?>
			</ul>
			<div class="tab-content">
				<?php
				$j = 0;
				while($j < count($categories))
				{
				$categories[$j]['titre'] = str_replace(' ', '_', $categories[$j]['titre']);
				?>
				
				<div id="categorie-<?php echo $j; ?>" class="tab-pane fade <?php if($j==0) echo 'in active show';?>" <?php if($j == 0) { echo 'aria-expanded="true"'; } else echo 'aria-expanded="false"'; ?>>
				<?php $categories[$j]['titre'] = str_replace('_', ' ', $categories[$j]['titre']); ?>
						<div class="panel-body">
							<?php if($categories[$j]['message'] == ""){ ?>
							<?php } else { ?>
							<p>
							<div class="alert alert-shop"><?php echo $categories[$j]['message']; ?></div>
							</p>
							<br>
							<?php } ?>
							<div class="row">
							<?php
								foreach($categories as $key => $value)
								{
									$categories[$key]['offres'] == 0;
								}
								for($i = 1; $i <= count($offresTableau); $i++)
								{
									if($offresTableau[$i]['categorie'] == $categories[$j]['id'])
									{
										echo '
										<div class="col-md-4 panel panel-default">
											<div class="offer" id="offer">
												<div class="panel-body">
														<h3 style="padding: 20px; margin: 0px;">'. $offresTableau[$i]['nom'] .'</h3>
													</div>
													';
														if(isset($_Joueur_)) {
														echo '<a data-toggle="tooltip" data-placement="bottom" title="Clic pour + d\'infos" href="?page=boutique&offre=' .$offresTableau[$i]['id']. '" class="btn btn-offer btn-block"><i class="fa fa-cart-arrow-down"></i> Voir ce produit</a>';}
														else { echo'<a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-warning btn-block" ><span class="glyphicon glyphicon-user"></span> Se connecter</a>'; }
											echo '<div class="price">' .$offresTableau[$i]['prix']. ' <i class="fas fa-gem"></i></div>
														</button>
											</div>

														
										</div>		';
										$categories[$j]['offres']++;
									}
								}
							?>
							</div>
							<?php 
							if($categories[$j]['offres'] == 0)
								echo '<div class="alert alert-dismissible alert-primary">
									<button type="button" class="close" data-dismiss="alert">&times;</button>
									<center id="alert-white">Oh zut ! '.$categories[$key]['titre'].' est encore vide, ré-essayez plus tard !</center>
								</div>';
							?>
						</div>
					</div>
				<?php $j++; } ?>	
			</div>
		</div>						
	<?php
	if(isset($_GET['offre']))
	{
	?>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title" id="myModalLabel"><b>Achat de : <?php echo $infosOffre['offre']['nom']; ?></b></h4>
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		  </div>
		  <div class="modal-body">
				<p>
					<span style="font-style=italic;">Vous obtiendrez ce grade sur <?php echo $infosCategories['serveur']; ?>.</span><br />
					<?php
					$enLigne = false;
					if($infosCategories['serveurId'] == -2 OR $infosCategories['serveurId'] == -1)
						for($i = 0; $i < count($lecture['Json']); $i++)
						{
							if($enligne[$i])
							{
								echo 'Vous êtes connecté sur le serveur:<br /> "'. $lecture['Json'][$i]['nom'] .'"';
								$enLigne = true;
							}
							
						}
					else
						if($enligne[$infosCategories['serveurId']])
						{
							echo 'Vous êtes connecté sur le serveur:<br /> "'. $lecture['Json'][$infosCategories['serveurId']]['nom'] .'"';
							$enLigne = true;
						}
						
					if(!$enLigne AND $infosCategories['connection'])
						echo 'Vous n\'êtes pas connecté sur le serveur !';
					?>
					<br>
					<b>Cette offre contiens :</b>
					<blockquote>
					<?php
					if(isset($infosOffre['offre']['description']))
						echo $infosOffre['offre']['description'];
					else
						echo 'Cette offre est un don sans contrepartie...';
					?>
					</blockquote>
				</p>
		  </div>
		  <div class="modal-footer">
			<?php 	if(($enLigne AND $infosCategories['connection']) OR !$infosCategories['connection']) { ?>
							<form action="index.php" method="GET" class="form-inline">
								<input type="hidden" name="action" value="addOffrePanier"/>
								<input type="hidden" name="offre" value="<?php echo $_GET['offre']; ?>"/>
								<h4 style="margin-right: 10px;">Quantité : </h4>
								<input type="number" class="form-control mb-1 mr-sm-1" id="quantite" name="quantite" value="1" />
								<button type="submit" class="btn btn-success mb-2">Ajouter au panier</button>
							</form><?php } else{ ?>
							<p class="text-body">Connectez-vous sur le serveur voulu...</p> <?php } 
					?>
		  </div><button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
		</div>
	  </div>
	</div>
	<?php

	$modal = true;
	$idModal = 'myModal';

	}
	?>
</div>
</section>
