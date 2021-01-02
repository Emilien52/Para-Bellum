<?php
$getprofil = $_GET['profil'];
$isMyAccount = false;
$nbrAccount = 0;

// GESTION D'ERREURS
if (isset($_GET['erreur'])) {
    $errorContent = '';
    switch ($_GET['erreur']) {
        case 1:
            $errorContent = 'Erreur, l\'email entré est vide...';
            break;

        case 2:
            $errorContent = 'Erreur, un des champs est trop court (minimum 4 caractères)';
            break;

        case 3:
            $errorContent = 'Erreur, le mot de passe entré ne correspond pas à celui associé à votre compte';
            break;

        case 4:
            $errorContent = 'Erreur, Vous n\'avez pas assez de tokens.';
            break;

        case 5:
            $errorContent = 'Erreur, Pseudonyme inconnu...';
            break;

        case 6:
            $errorContent = 'Erreur, Extension non autorisée !';
            break;

        case 7:
            $errorContent = 'Erreur, Fichier trop volumineux ! <small>Maximum 2Mo</small>';
            break;

        case 8:
            $errorContent = 'Erreur, Des champs sont manquants !';
            break;

        case 9:
            $errorContent = 'Erreur, Impossible de vous abonner / désabonner à votre Newsletter...';

        case 10:
            $errorContent = 'Erreur, Impossible d\'afficher / cacher votre email...';

        default:
            $errorContent = 'Une erreur est survenue lors de l\'enregistrement de vos informations !';
            break;
    }
    //GESTION DE SUCCÈS
} elseif (isset($_GET['success'])) {
    $successContent = '';
    switch ($_GET['success']) {
        case 'true':
            $successContent = 'Vos informations ont bien été changé !';
            break;

        case 'jetons':
            if (!isset($_GET['montant']) || !is_numeric($_GET['montant'])) {
                $_GET['montant'] = 'NaN';
            }
            if (!isset($_GET['pseudo'])) {
                $_GET['pseudo'] = 'NOT_FOUND';
            }
            $successContent = 'Vous venez d\'envoyer ' . htmlspecialchars($_GET['montant']) . ' '.$_Serveur_['General']['moneyName'].' à ' . htmlspecialchars($_GET['pseudo']) . ' !';
            break;

        case 'image':
            $successContent = 'Votre photo de profil a été modifiée !';
            break;

        case 'imageRemoved':
            $successContent = 'Votre photo de profil a bien été supprimée de nos serveurs !';
            break;

        default:
            $successContent = '<div class="text-danger">Message de succès introuvable...</div>';
    }
}
?>
<style>
.btn-white {
    border: 1px solid #fff;
}
.btn-white, .btn-white i {
    background: var(--color-main);
    color: #fff !important;
    border-radius: 15px 15px 0 0;
}
.btn-white[aria-expanded="true"], .btn-white[aria-expanded="true"] i{
    background: #fff;
    color: var(--color-main) !important;
}
.card-hidden {
    background: none;
    border: none;
    margin: 0;
    padding: 0;
}
.form-horizontal .card-body *:not(button):not(.active) {
    color: var(--color-main) !important;
}
.categorie-link {
    border: 1px solid var(--color-main) !important;
    transition-duration: .5s;
}
.categorie-link.active{
    background: var(--color-main);
    color: #fff !important;
}

.social-user :nth-child(2n){
    color: var(--color-main) !important;
    padding-top: 5px;
}
.social-user :nth-child(2n+1){
    background: var(--color-main);
    padding: 5px 15px 5px 15px;
    border-radius: 5px;
}
.text-presentation-profile {
    background: #fff;
    border-radius: 15px;
}
.text-presentation-profile div,.text-presentation-profile span{
    color: var(--color-main) !important;
}
</style>
<section class="layout" id="white">
	<div class="container">
		<h1 class="titre text-uppercase">Profil de <?= $_GET['profil'] ?></h1>
	</div>
</section>
<section class="layout" id="page">
    <div class="container-fluid col-md-9 col-lg-9 col-sm-10">

        <?php if (isset($_Joueur_["pseudo"]) && $_Joueur_['pseudo'] != $_GET['profil']) :
            $isMyAccount = false; ?>
        <?php endif; ?>

        <?php if (isset($_Joueur_) and $_GET['profil'] === $_Joueur_['pseudo']) :
            $isMyAccount = true ?>
			
	<?php
		if(isset($successContent)){
			echo "<div class='alert bg-success text-white'><center>".$successContent."</center></div>";
		}
		if(isset($errorContent)){
			echo "<div class='alert bg-danger text-white'><center>".$errorContent."</center></div>";
		}	
	?>

        <!-- Gestion du compte -->
		<div class="card card-hidden" id="collapseContainer">
			<div class="row">

				<div class="d-flex flex-row-reverse">
					<a class="btn btn-white p-2 my-3 mr-3" data-toggle="collapse" href="#collapseGiveJetons" role="button" aria-expanded="false" aria-controls="collapseGiveJetons">
						<i class="fas fa-gift mr-1"></i> Offrir des <?=$_Serveur_['General']['moneyName'];?>s
					</a>
					<a class="btn btn-white p-2 my-3 mx-3" data-toggle="collapse" href="#collapseEditSettings" role="button" aria-expanded="false" aria-controls="collapseEditSettings">
						<i class="fas fa-pencil-alt mr-1"></i> Modifier mon compte
					</a>
				</div>

			</div>


			<!-- Offrir des jetons -->
			<div class="row">

				<div class="collapse mx-auto" id="collapseGiveJetons" data-parent="#collapseContainer">
					<div class="card">
						<form class="form-horizontal" method="post" action="?&action=give_jetons" role="form">

							<div class="card-header bg-parabellum">
								<h4> Envoyer des <?=$_Serveur_['General']['moneyName'];?>s à un joueur </h4>
							</div>

							<div class="card-body text-dark">

								<div class="form-row py-1">

									<div class="col-md-8">
										<label for="pseudo"> Pseudo </label>
										<div class="input-group">
											<span class="input-group-prepend">
												<div class="input-group-text bg-main border-0">
													<i class="fas fa-user"></i>
												</div>
											</span>
											<input type="text" name="pseudo" class="form-control custom-text-input"
												id="pseudo" placeholder="Pseudo du receveur" required>
										</div>
									</div>


									<div class="col-md-4">
										<label for="montant"> Montant </label>
										<div class="input-group">
											<span class="input-group-prepend">
												<div class="input-group-text bg-main border-0">
													<i class="fas fa-money-bill-alt"></i>
												</div>
											</span>
											<input type="number" name="montant" class="form-control custom-text-input"
												id="montant" placeholder="Montant" required>
										</div>
									</div>

								</div>

							</div>

							<div class="card-footer">
								<button type="submit" class="btn btn-parabellumW btn-block">Envoyer</button>
							</div>

						</form>
					</div>
				</div>

			</div>


			<!-- Modification du compte -->
			<div class="row">
				<div class="collapse mx-auto col-10" id="collapseEditSettings" data-parent="#collapseContainer">
					<div class="card form-horizontal">

						<div class="card-header bg-parabellum">
							<h4> Modifier les informations de mon compte </h4>
						</div>
						
						<div class="card-body">
							<div class="row">
								<div class="col-md-12 col-lg-3 col-sm-12 mb-3 ml-lg-3">
									<!-- Navigation -->
									<div class="categories">
										<ul class="categorie-content nav nav-tabs">
											<li class="categorie-item nav-item">
												<a href="#editPersonal" class="nav-link categorie-link active"
													data-toggle="tab" aria-controls="editPersonal" aria-selected="true">
													Informations personnelles
												</a>
											</li>

											<li class="categorie-item nav-item">
												<a href="#editOptionnal" class="nav-link categorie-link" data-toggle="tab"
													aria-controls="editOptionnal" aria-selected="false">
													Informations optionnelles
												</a>
											</li>
										</ul>
									</div>
								</div>


								<div class="col-md-12 col-lg-8 col-sm-12 mb-3 ml-lg-3">
									<!-- Contenu -->
									<div class="tab-content">

										<div id="editPersonal" class="tab-pane fade show active" role="tabpanel"
											aria-labelledby="editPersonal">

											<form class="form-horizontal" method="post" action="?&action=changeProfil"
												role="form">

												<div class="form-row py-1">

													<div class="col-md-12 py-2">
														<label for="namePseudo"> Pseudo </label>
														<div class="input-group">
															<span class="input-group-prepend">
																<div class="input-group-text bg-main border-0">
																	<i class="fa fa-user"></i>
																</div>
															</span>
															<input type="text" name="pseudo" class="form-control custom-text-input" id="namePseudo" value="<?= $joueurDonnees['pseudo']; ?>" disabled style="cursor: not-allowed">
														</div>
													</div>

												</div>

												<h5 class="mt-4 mb-0">Modifier votre mot de passe : <small>(Laisser vide pour ne pas modifier)</small></h5>
												<hr class="bg-main w-80 float-left my-1">
												<div class="clearfix"></div>

												<div class="form-row py-2">

													<div class="col-md-12 mb-2">
														<label for="mdpAncien"> Mot de passe Actuel </label>
														<div class="input-group">
															<span class="input-group-prepend">
																<div class="input-group-text bg-main border-0">
																	<i class="fas fa-key"></i>
																</div>
															</span>
															<input type="password" name="mdp" class="form-control custom-text-input" id="mdpAncien" placeholder="Entrez votre mot de passe">
														</div>
													</div>

													<div class="col-md-6">
														<label for="mdpNouveau"> Nouveau mot de passe </label>
														<div class="input-group">
															<span class="input-group-prepend">
																<div class="input-group-text bg-main border-0">
																	<i class="fas fa-key"></i>
																</div>
															</span>
															<input type="password" name="mdpNouveau" class="form-control custom-text-input" id="mdpNouveau" placeholder="Entrez votre nouveau mot de passe">
														</div>
													</div>

													<div class="col-md-6">
														<label for="mdpConfirme"> Confirmation Mot de passe </label>
														<div class="input-group">
															<span class="input-group-prepend">
																<div class="input-group-text bg-main border-0">
																	<i class="fas fa-key"></i>
																</div>
															</span>
															<input type="password" name="mdpConfirme" class="form-control custom-text-input" id="mdpConfirme" placeholder="Confirmez votre nouveau mot de passe">
														</div>
													</div>

												</div>

												<h5 class="mt-4 mb-0">Modifier votre mail : <small>(Laisser vide pour ne pas modifier)</small></h5>
												<hr class="bg-main w-80 float-left my-1">
												<div class="clearfix"></div>

												<div class="form-row py-2">

													<div class="col-md-8">
														<label for="inputMail"> Email </label>
														<div class="input-group">
															<span class="input-group-prepend">
																<div class="input-group-text bg-main border-0">
																	<i class="fa fa-user"></i>
																</div>
															</span>
															<input type="email" name="email" class="form-control custom-text-input" id="inputMail" placeholder="Entrez votre mail" value="<?= $joueurDonnees['email']; ?>">
														</div>
													</div>

													<div class="col-md-4">
														<?php if ($joueurDonnees['show_email']) : ?>
														<button type="submit" class="btn btn-parabellumW form-control" name="changeVisibilityMail" value="hideMail" style="margin-top: 1.9rem">
															Cacher
														</button>
														<?php else : ?>
														<button type="submit" class="btn btn-parabellumW form-control"
															name="changeVisibilityMail" value="showMail"
															style="margin-top: 1.9rem">
															Afficher
														</button>
														<?php endif; ?>
													</div>
												</div>


												<div class="form-row py-2">
													<div class="col-md-8">
														<label for="inputNewsletter"> Abonnement à la Newsletter </label>
														<div class="input-group">
															<span class="input-group-prepend">
																<div class="input-group-text bg-main border-0">
																	<i class="fas fa-plus-square"></i>
																</div>
															</span>

															<?php if ($joueurDonnees['newsletter']) : ?>
															<input type="text" class="form-control custom-text-input text-success" id="inputNewsletter" name="inputNewsletter" value="Déjà abonné !" disabled />
															<?php else : ?>
															<input type="text" class="form-control custom-text-input text-danger" id="inputNewsletter" name="inputNewsletter" value="Non abonné !" disabled />
															<?php endif; ?>
														</div>
													</div>

													<div class="col-md-4">
														<?php if ($joueurDonnees['newsletter']) : ?>
														<button type='submit' class="btn btn-parabellumW form-control text-danger" name="changeNewsletter" value="unsubscribeNewsletter" style="margin-top: 1.9rem">Se désinscrire
														</button>

														<?php else : ?>

														<button type='submit' class="btn btn-parabellumW form-control" name="changeNewsletter" value="subscribeNewsletter" style="margin-top: 1.9rem">S'inscrire
														</button>
														
														<?php endif; ?>
													</div>

													<div class="row w-100">
														<div class="col-12 mt-4">
															<button type="submit" class="btn btn-parabellumW form-control"> Valider mes changements
															</button>
														</div>
													</div>
												</div>

											</form>
										</div>

										<div id="editOptionnal" class="tab-pane fade" role="tabpanel" aria-labelledby="editOptionnal">
											<form class="form-horizontal" method="post" action="?&action=changeProfilAutres"
												role="form">

												<?php foreach ($listeReseaux as $value) : ?>

												<div class="form-row py-1">
													<label for="<?= $value['nom']; ?>">
														<?= ucfirst($value['nom']); ?>
													</label>
													<input type="text" class="form-control custom-text-input" name="<?= $value['nom']; ?>" placeholder="Votre nom d'utilisateur <?= $value['nom']; ?>" value="<?php if ($joueurDonnees[$value['nom']] !== 'inconnu') echo $joueurDonnees[$value['nom']]; ?>">
												</div>

												<?php endforeach; ?>

												<div class="form-row">
													<label for="age">
														Âge <small>(0 = caché)</small>
													</label>
													<input type="number" name="age" class="form-control custom-text-input "
														min="0" max="99" placeholder="17"
														value="<?php if ($joueurDonnees['age'] !== 'inconnu') echo $joueurDonnees['age']; ?>">

												</div>


												<div class="form-row wys-content">
													<h5 class="mt-4 mb-0">Signature Forum</h5>
													<hr class="bg-main w-80 float-left my-1">
													<div class="clearfix"></div>

													<div class="col-md-12 text-center wys-options">
														<textarea  data-UUID="0005" id="ckeditor" name="signature" style="height: 275px; margin: 0px; width: 100%;"></textarea>
													</div>
												</div>

												<div class="row w-100">
													<div class="col-12 mt-4">
														<button type="submit" class="btn btn-parabellumW form-control">
															Valider mes changements
														</button>
													</div>
												</div>

											</form>
										</div>

									</div>
								</div>
							</div>


						</div>

					</div>
				</div>
			</div>
        </div>

        <?php endif; ?>


        <!-- Affichage Profile -->
        <div class="row">


            <!-- Image et edition de la photo de profil -->
            <?php if ($isMyAccount) : ?>
			
			<div class="col-sm-12 mb-3">
				<div class="row">
					<div class="col-md-6">
						<h3 class="header-bloc header-form text-center">Modifier sa photo de profil</h3>
						<form class="form-horizontal" method="post" action="?action=modifImgProfil" role="form" enctype="multipart/form-data">
							<div class="form-group">
								<label for="img-profil" class="control-label">Importer votre image (&lt; 1Mo, jpeg, jpg, png, bmp, ico, gif)</label>
								<input type="file" name="img_profil" required class="form-control-file text-white" id="img-profil">
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-success">Envoyer</button>
							</div>
						</form>
					</div>
					<div class="col-md-6">
						<h3 class="header-bloc text-center">Photo de profil actuelle</h3>
						<?php
						echo "<center><img src='".$_ImgProfil_->getUrlHeadByPseudo($_Joueur_['pseudo'], 128)."' style='width: 128px; height: 128px;' alt='Image de profil de ".htmlspecialchars($joueurDonnees['pseudo'])."'/></center>";
						?>
						<center><a class="btn btn-danger" style="margin-top: 10px;" href="?action=removeImgProfil">Supprimer</a></center>
					</div>
				</div>
			</div>

            <?php else : ?>
            <div class="col-sm-12 mb-3">
				<h3 class="header-bloc text-center">Photo de profil actuelle</h3>
				<?php
				echo "<center><img src='".$_ImgProfil_->getUrlHeadByPseudo($_Joueur_['pseudo'], 128)."' style='width: 128px; height: 128px;' alt='Image de profil de ".htmlspecialchars($joueurDonnees['pseudo'])."'/></center>";
				?>
			</div>
            <?php endif; ?>

            <div class="col-sm-6">
                <div class="text-presentation-profile text-white">
                    <div class="p-2">
                        <span class="font-weight-bolder"> <?= $gradeSite ?>
                        </span><?= htmlspecialchars($joueurDonnees['pseudo']); ?>
                    </div>
                    <div class="p-2">
                        Inscrit le <?= date('d/m/Y', $joueurDonnees['anciennete']); ?>
                    </div>
                    <?php if ($joueurDonnees['age'] > 5 && $joueurDonnees['age'] != "??") : ?>
                    <div class="p-2">
                        <?= $joueurDonnees['age'] ?> ans
                    </div>
                    <?php endif; ?>
                    <div class="p-2">
                        <?php require_once("modele/topVotes.class.php");
                        $topVotes = new TopVotes($bddConnection);
                        $nbreVotes = $topVotes->getNbreVotes($getprofil); ?>
                        <?= $nbreVotes . ' ' . ($nbreVotes > 1 ? "votes" : "vote"); ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">

                <div class="card text-white">

                    <div class="card-header bg-parabellum">
                        Comptes de <?= $joueurDonnees['pseudo'] ?>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <ul class="list-group list-group-flush w-100">
                                <?php if ($joueurDonnees['show_email']) :
                                    $nbrAccount++ ?>

                                <li class="social-user list-group-item bg-lightest">
                                    <div class="float-left">E-mail : </div>
                                    <div class="float-right"><?= $joueurDonnees['email'] ?> </div>
                                </li>

                                <?php endif; ?>

                                <?php foreach ($listeReseaux as $reseauSocial) :
                                    if ($joueurDonnees[$reseauSocial['nom']] != "inconnu") :
                                        $nbrAccount++ ?>

                                <li class="social-user list-group-item bg-lightest">
                                    <div class="float-left"><?= ucfirst($reseauSocial['nom']); ?> : </div>
                                    <div class="float-right"><?= $joueurDonnees[$reseauSocial['nom']]; ?> </div>
                                </li>

                                <?php endif; ?>
                                <?php endforeach; ?>

                                <?php if ($nbrAccount == 0) : ?>
                                <li class="list-group-item bg-danger p-3">Aucun Compte à afficher</li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div class="col-10 text-center mx-auto text-white">
            <h4 class="my-5 text-left">Signature : </h4>
            <?php if (!empty($joueurDonnees['signature'])) : ?>

            <blockquote class="blockquote about-content col-8 mx-auto">
                <p class="ml-4 mb-0 h5"> <?= $joueurDonnees['signature'] ?> </p>
            </blockquote>

            <?php else : ?>
            <div class="alert alert-main col-10 mx-auto">
                <p class="mb-0 h4 ml-3 p-3"> Ce joueur n'a aucune signature... </p>
            </div>
            <?php endif; ?>
        </div>

    </div>
</section>
