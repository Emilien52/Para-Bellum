<style>
.color-red{color:var(--color-main) !important;}.modal-body span {font-style: normal;}
blockquote {
    border-right: 0;
    border-left: 5px solid #ccc;
    padding-left: 20px;
}
select option {
	color:#000 !important;
}
.modal-header{
    background: var(--color-main);
}
</style>
<section class="layout" id="white">
	<div class="container">
		<h1 class="titre text-uppercase"><span class="fa fa-user-md"></span> Support communautaire</h1>
	</div>
</section>
<section class="layout" id="pageBg">
	<div class="container">
		<div class="info-container text-white">
			<h3><strong><span class="fas fa-info-circle"></span> Comment ça marche ?</strong></h3>
			<p>Postez des tickets, lisez ceux des autres, répondez à la communauté et discutez avec l'équipe du serveur !</p>
		</div>
		<br>
		<div class="white-container">
			<!-- Tableau des Tickets  -->
			<table class="table table-bordered">
				<thead class="thead-inverse bg-parabellum">
					<tr>
						<?php if (Permission::getInstance()->verifPerm('PermsDefault', 'support', 'displayTicket')) : ?>
							<th style="text-align: center;">Visibilité</th>
						<?php endif; ?>
						<th style="text-align: center;">Pseudo</th>
						<th style="text-align: center;">Titre</th>
						<th style="text-align: center;">Date</th>
						<th style="text-align: center;">Action</th>
						<th style="text-align: center;">Status </th>
						<?php if (Permission::getInstance()->verifPerm('PermsDefault', 'support', 'closeTicket')) : ?>
							<th style="text-align: center;">Modification</th>
						<?php endif; ?>
					</tr>
				</thead>
				<tbody>
				<?php $j = 0;
					while ($tickets = $ticketReq->fetch(PDO::FETCH_ASSOC)) : ?>

						<!-- Listing des tickets -->
						<tr>
							<?php if ($tickets['ticketDisplay'] == 0 or $tickets['auteur'] == $_Joueur_['pseudo'] or Permission::getInstance()->verifPerm('PermsDefault', 'support', 'displayTicket')) :
								if (Permission::getInstance()->verifPerm('PermsDefault', 'support', 'displayTicket')) : ?>
									<td class="align-middle color-red">
										<?php if ($tickets['ticketDisplay'] == "0") : ?>
											<center><span><i class="fas fa-eye color-red"></i> Public</span></center>
										<?php else : ?>
											<center><span ><i class="fas fa-eye-slash color-red"></i> Privé</span></center>
										<?php endif; ?>
									</td>
								<?php endif; ?>

								<td class="text-center align-middle color-red">
									<a href="index.php?&page=profil&profil=<?= $tickets['auteur'] ?>" class="color-red">
										<img class="icon-player-topbar" src="<?= $_ImgProfil_->getUrlHeadByPseudo($tickets['auteur'], 32) ?>" style="width: 32px; height: 32px" />
										<?= $tickets['auteur'] ?>
									</a>
								</td>

								<td class="text-center align-middle color-red">
									<?= $tickets['titre'] ?>​
								</td>

								<td class="text-center align-middle color-red">
									<?php echo $_Forum_->conversionDate($tickets['date_post']); ?>
								</td>

								<td class="text-center align-middle">
									<a class="btn btn-info btn-sm" data-toggle="modal" href="#" data-target="#slide-<?= $tickets['id']; ?>" data-dismiss="modal">
										Voir <i style="color: #fff;" class="fa fa-eye"></i>
									</a>
								</td>

								<td class="text-center align-middle">
									<?php
									$ticketstatus = $tickets['etat'];
									if ($ticketstatus == "1") : ?>
										<button class="btn btn-success">Résolu <span class="glyphicon glyphicon-ok"></span></button>
									<?php else : ?>
										<button class="btn btn-warning">Non Résolu <span class="glyphicon glyphicon-remove"></span></button>
									<?php endif; ?>
								</td>

								<?php if (Permission::getInstance()->verifPerm('PermsDefault', 'support', 'closeTicket')) : ?>
									<td style="text-align: center;">
										<form class="form-horizontal default-form" method="post" action="?&action=ticketEtat&id=<?= $tickets['id']; ?>">
											<?php if ($tickets['etat'] == 0) : ?>
												<button type="submit" name="etat" class="btn btn-warning" value="1">
													Fermer le ticket
												</button>
											<?php else : ?>
												<button type="submit" name="etat" class="btn btn-warning" value="0">
													Ouvrir le ticket
												</button>
											<?php endif; ?>
										</form>
									</td>
							<?php endif;
							endif; ?>
							
							<!-- Modal du ticket support -->
                            <?php if ($tickets['ticketDisplay'] == "0" or $tickets['auteur'] == $_Joueur_['pseudo'] or Permission::getInstance()->verifPerm('PermsDefault', 'support', 'displayTicket')) :
                                $ticketstatus = $tickets['etat'];

                                unset($message);
                                $message = $tickets['message'];

                                $commentaires = 0; ?>

                                <div class="modal fade" id="slide-<?= $tickets['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="slide-<?= $tickets['id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-support">
                                        <div class="modal-content">
                                            <div class="modal-header">										
											<?php
												if($ticketstatus == 1){
													echo '<span class="badge badge-success" style="color: white; margin-right: 10px; font-size: 23px;">Résolu !</span>';
												} else {
													echo '';
												}
											?>
												<h4 class="modal-title" id="myModalLabel"><b style="color: white;"><?php echo $tickets['titre']; ?></b></h4>
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>


                                            <!-- Message d'aide -->
                                            <div class="modal-body">												
                                                <div class="media">
                                                    <p class="username">
                                                        <img class="mr-3" src="<?= $_ImgProfil_->getUrlHeadByPseudo($tickets['auteur'], 32); ?>" style="width: 32px; height: 32px;" alt="Avatar de <?= $tickets['auteur'] ?>" />
                                                        <div class="media-body">
                                                            <h6 class="mt-0 mb-2 font-weight-bold">
                                                                <?= $tickets['auteur']; ?> | le <?= $_Forum_->conversionDate($tickets['date_post']); ?>
                                                            </h6>
                                                            <?= $message; ?>
                                                               

                                                            <hr class="bg-main w-100">

                                                            <!-- Commentaires -->
                                                            <?php if (isset($ticketCommentaires[$tickets['id']])) :

                                                                for ($i = 0; $i < count($ticketCommentaires[$tickets['id']]); $i++) :

                                                                    unset($message);
                                                                    $message = $ticketCommentaires[$tickets['id']][$i]['message'];
                                                            ?>


                                                                    <div class="media">
                                                                        <p class="username">
                                                                            <img class="mr-3" src="<?= $_ImgProfil_->getUrlHeadByPseudo($ticketCommentaires[$tickets['id']][$i]['auteur'], 32); ?>" style="width:32px; height:32px;" alt="Avatar de <?= $ticketCommentaires[$tickets['id']][$i]['auteur'] ?>" />
                                                                            <div class="media-body">
                                                                                <h6 class="mt-0 mb-2 font-weight-bold">
                                                                                    <?= $ticketCommentaires[$tickets['id']][$i]['auteur']; ?> | le <?= $_Forum_->conversionDate($ticketCommentaires[$tickets['id']][$i]['date_post']); ?>
                                                                                </h6>
                                                                                <div id="contenueCom<?= $tickets['id'] ?>-<?= $ticketCommentaires[$tickets['id']][$i]['id'] ?>" style="margin-bottom:10px;"><?= $message; ?></div>

                                                                                <!-- Actions possible sur les commentaires -->
                                                                                <?php if ((isset($_Joueur_))  &&  (($ticketCommentaires[$tickets['id']][$i]['auteur'] == $_Joueur_['pseudo'] || Permission::getInstance()->verifPerm('PermsDefault', 'support', 'deleteMemberComm')) || ($ticketCommentaires[$tickets['id']][$i]['auteur'] == $_Joueur_['pseudo'] || Permission::getInstance()->verifPerm('PermsDefault', 'support', 'editMemberComm')))) : ?>

                                                                                    <div class="dropdown">
                                                                                        <a class="btn btn-parabellumW no-hover float-right" data-toggle="dropdown">Action <b class="caret"></b></a>
                                                                                        <ul class="dropdown-menu">

                                                                                            <?php if ($ticketCommentaires[$tickets['id']][$i]['auteur'] == $_Joueur_['pseudo'] or Permission::getInstance()->verifPerm('PermsDefault', 'support', 'deleteMemberComm')) : ?>

                                                                                                <li>
                                                                                                    <a href="?&action=delete_support_commentaire&id_comm=<?= $ticketCommentaires[$tickets['id']][$i]['id'] ?>&id_ticket=<?= $tickets['id'] ?>&auteur=<?= $ticketCommentaires[$tickets['id']][$i]['auteur'] ?>" class="dropdown-item text-muted">
                                                                                                        Supprimer
                                                                                                    </a>
                                                                                                </li>

                                                                                            <?php endif; ?>

                                                                                            <?php if ($ticketCommentaires[$tickets['id']][$i]['auteur'] == $_Joueur_['pseudo'] or Permission::getInstance()->verifPerm('PermsDefault', 'support', 'editMemberComm')) : ?>
                                                                                                <li>
                                                                                                    <a href="#editComm-<?= $ticketCommentaires[$tickets['id']][$i]['id'] ?>" data-toggle="modal" data-target="#editComm-<?= $ticketCommentaires[$tickets['id']][$i]['id'] ?>" class="dropdown-item text-muted" data-dismiss="modal">Editer</a>
                                                                                                </li>
                                                                                            <?php endif; ?>
                                                                                        </ul>
                                                                                    </div>

                                                                                <?php endif; if($tickets['etat'] == "0") { ?>
																					<button type="button" onclick="addBlockQuote('ckeditorCom<?= $tickets['id'] ?>','contenueCom<?= $tickets['id'] ?>-<?= $ticketCommentaires[$tickets['id']][$i]['id'] ?>', '<?= $ticketCommentaires[$tickets['id']][$i]['auteur']; ?>');" class="btn btn-dark float-right mb-5" style="margin-right:15px;">Citer !</button>
                                                                                <?php } ?>
                                                                            </div>
                                                                        </p>
                                                                    </div>




                                                                <?php endfor; ?>
                                                            <?php endif; ?>


                                                        </div>
                                                    </p>
                                                </div>


                                            </div>

                                            <div class="modal-footer form-comment">
												<!-- Envoie d'un commentaire -->
											<?php if($tickets['etat'] == "0"){ ?>
													<form action="?&action=post_ticket_commentaire" method="post">
														<input type="hidden" name="id" value="<?= $tickets['id'] ?>"/>
														<div class="row" style="width:100%;margin:0">
															<div class="col-sm-12" style="width:100%;">
																<textarea data-UUID="0006<?= $tickets['id'] ?>" id="ckeditorCom<?= $tickets['id'] ?>" name="message" style="height: 275px;"></textarea>
															</div>
															<div class="col-sm-12 mb-4">
																<button type="submit" class="btn btn-block btn-parabellumW">Commenter</button>
															</div>
														</div>
													</form>
											<?php } else { ?>
													<form action="" method="post">
														<textarea style="text-align: center;"name="message" class="form-control" rows="2" placeholder="Ticket résolu ! Merci de contacter un administrateur pour réouvrir votre ticket." disabled></textarea>
													</form>
											<?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php endif; ?>

                            <!-- Edition d'un commentaire -->

                            <?php if ($ticketCommentaires[$tickets['id']][$i]['auteur'] == $_Joueur_['pseudo'] or Permission::getInstance()->verifPerm('PermsDefault', 'support', 'editMemberComm')) :
                                if (!empty($ticketCommentaires[$tickets['id']])) :
                                    for ($i = 0; $i < count($ticketCommentaires[$tickets['id']]); $i++) : ?>

                                        <div class="modal fade" id="editComm-<?= $ticketCommentaires[$tickets['id']][$i]['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editComm">
                                            <form method="POST" action="?&action=edit_support_commentaire&id_comm=<?= $ticketCommentaires[$tickets['id']][$i]['id']; ?>&id_ticket=<?= $tickets['id']; ?>&auteur=<?= $ticketCommentaires[$tickets['id']][$i]['auteur']; ?>">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">

                                                        <div class="modal-header color-red">
                                                            <h4 class="modal-title" style="color: white;">Edition du commentaire</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true" class="color-red">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="col-lg-12 text-center">


                                                                <div class="row mt-4">
                                                                    <div style="width:100%;">
                                                                        <textarea data-UUID="0015" name="editMessage" class="form-control custom-text-input" style="height: 275px; ">
                                                                        <?= $ticketCommentaires[$tickets['id']][$i]['message']; ?></textarea>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
															<button type="submit" class="btn btn-block btn-parabellum">Valider !</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    <?php endfor; ?>
                                <?php endif; ?>
                            <?php endif; ?>

                        <?php $j++;
                        endwhile; ?>
					</tr>
				</tbody>
			</table>
		
			<div class="row">
				<!-- Création de Ticket -->
				<?php if (!Permission::getInstance()->verifPerm("connect")) : ?>

					<a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-main w-100">
						<i class="fas fa-sign-in-alt"></i> Se connecter pour ouvrir un ticket
					</a>
				<?php else : ?>
				
					<button data-toggle="collapse" href="#ticketCree" role="button" aria-expanded="false" aria-controls="ticketCree" class="btn btn-parabellumW w-100 mb-3">
						<i class="fas fa-pen-square color-red"></i> Poster un ticket !
					</button>
				<?php endif; ?>
			</div>
		</div>
		
	<?php if (Permission::getInstance()->verifPerm("connect")) : ?>
		<br>
		<div class="collapse" id="ticketCree">
			<div class="white-container">
				<div class="card">
					<form action="index.php?action=post_ticket" method="post" >
						<div class="card-body">
							<div class="row">
								<div class="col-sm-8">
									<div class="form-group">
										<label for="titre_ticket" class="color-red">Sujet</label>
										<div class="form-group">
											<div class="input-group">
												<input type="text" id="titre_ticket" class="form-control custom-text-input" name="titre" placeholder="Sujet">
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="vu_ticket" class="color-red">Visibilité</label>
										<?php
										if (!isset($_Serveur_["support"]["visibilite"]) || $_Serveur_["support"]["visibilite"] == "both") : ?>
											<select class="form-control custom-text-input" id="vu_ticket" name="ticketDisplay">
												<option value="0">Publique</option>
												<option value="1">Privée</option>
											</select>
										<?php else : ?>
											<select class="form-control custom-text-input" id="vu_ticket" name="ticketDisplay">
												<?php if ($_Serveur_["support"]["visibilite"] == "prive") : ?>
													<option value="1">Privée</option>
												<?php else : ?>
													<option value="0">Publique</option>
												<?php endif; ?>
											</select>
										<?php endif; ?>
									</div>
								</div>
							</div>
							<div class="form-group mb-0">
							   
								<label for="message_ticket" class="color-red">Description détaillée</label>
								<textarea  data-UUID="0007" id="ckeditor" name="message" style="height: 275px; margin: 0px; width: 100%;"></textarea>
							</div>
						</div>
						<div class="card-footer text-center">
							<button type="submit" class="btn btn-parabellumW btn-block">Envoyer</button>
						</div>
					</form>
				</div>
			</div>
		</div>

	<?php endif; ?>
		
		</div>
    </div>
</section>