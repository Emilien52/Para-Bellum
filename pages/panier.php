<?php

if (Permission::getInstance()->verifPerm("connect")) :

    //Création du Panier : 
    $nbArticles = $_Panier_->compterOffre();
    $precedent = 0;
?>
<!--
<style>
.table-striped {
    background: #fff;
    color: var(--color-main);
    border: 1px solid var(--color-main);
}

.table-striped th, .table-striped td, .table-striped p, .table-striped center {
    color: var(--color-main) !important;
}

.color-main {
    color: var(--color-main) !important;
}

.table-striped thead th {
    border-bottom: 2px solid var(--color-main);
}
</style>!-->
<style>
.btn-offer:hover {
    color: #5cb85c;
    background: rgba(255,255,255,0.9);
}
</style>

	<section class="layout" id="white">
		<div class="container">
			<h1 class="titre text-uppercase"><span class="fa fa-shopping-basket"></span> Panier</h1>
		</div>
	</section>
	<section class="layout" id="page">
		<div class="container">
			<div class="info-container">
				<h3><strong><span class="fas fa-info-circle"></span> Comment ça marche ?</strong></h3>
				<p>C'est très simple, vous ajoutez vos items de la boutique dans votre panier puis vous achetez le tout en une seule fois !</p>
			</div>
			
			<table class="table table-striped table-bordered mt-4">
				<thead class="thead-inverse">
					<tr>
						<th>Item/Grade</th>
						<th>Description</th>
						<th>Quantite</th>
						<th>Prix Unitaire</th>
						<th>Sous-Total</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$nbArticles = $_Panier_->compterArticle();
					$precedent = 0;
					if($nbArticles == 0 )
						echo '<tr><td colspan="6"><center>Votre panier est vide :\'( </center></td></tr>';
					else {
						for($i = 0; $i < $nbArticles; $i++){
							?>
							<tr>
								<td><?php $_Panier_->infosArticle(htmlspecialchars($_SESSION['panier']['id'][$i]), $nom, $infos); echo $nom; ?></td>
								<td><?php echo $infos; ?></td>
								<td><?php echo htmlspecialchars($_SESSION['panier']['quantite'][$i]); ?></td>
								<td class="w-25 text-center"><?php echo htmlspecialchars($_SESSION['panier']['prix'][$i]); ?> <i class="fa fa-diamond"></i></td>
								<td class="w-25 text-center"><?php $precedent += htmlspecialchars($_SESSION['panier']['prix'][$i])*htmlspecialchars($_SESSION['panier']['quantite'][$i]);
								echo $precedent; ?> <i class="fas fa-gem color-main"></i></td>
								<td><a href="?action=supprItemPanier&id=<?php echo htmlspecialchars($_SESSION['panier']['id'][$i]); ?>" class="btn btn-danger link" title="supprimer l'item du panier"><i class="fa fa-trash"></i></a></td>
							</tr>
						   <?php
						} 
						if(!empty($_SESSION['panier']['reduction'])){
							echo '<tr><td>'.htmlspecialchars($_SESSION['panier']['code']).'</td><td>'.htmlspecialchars($_SESSION['panier']['reduction_titre']).'</td><td>1</td><td class="w-25 text-center">-'. $_SESSION['panier']['reduction']*100 .'%</td><td></td><td><a href="?action=retirerReduction" class="btn btn-danger link" title="supprimer la réduction"><i class="fa fa-trash"></i></a></td></tr>';
						}
					}
				?>
					<tr>
						<td>Total:</td>
						<td class="w-25 text-center" colspan="5"><?php echo number_format($_Panier_->montantGlobal(), 0, ',', ' '); ?> <i class="fas fa-gem color-main"></i></td>
					</tr>
				</tbody>
			</table>
			<?php if ($nbArticles != 0) : ?>
				<!-- Affichage du formulaire des codes de promotion -->
				<form class="form-inline" action="?action=ajouterCode" method="POST">
					<div class="form-group">
						<input type="text" class="form-control" id="codepromo" name="codepromo" placeholder="Code promo" style="border:0px;">
					</div>
					<button type="submit" class="btn btn-info link" style="border:0px;">Envoyer</button>
				</form>
				<div class="text-right">
					<a href="?action=viderPanier"><button class="btn btn-lg btn-danger hvr-float-shadow">Vider le panier !</button></a>
					<a href="?action=achat"><button class="btn btn-lg btn-offer hvr-float-shadow">Acheter !</button></a>
				</div>			
			<?php endif; ?>
        </div>
    </section>
<?php endif; ?>