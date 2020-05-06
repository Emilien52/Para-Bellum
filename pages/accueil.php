<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>

<!--Header-->
    <header class="heading" style="background-image: url('theme/upload/slider/<?php echo $_Accueil_['Slider']['image']; ?>');" id="header">
        <div class="heading-mask">
            <div class="container" style="text-align:center;">

				<h1 class="text-uppercase wow zoomInDown" data-wow-delay="0.6s"><?php echo $_Serveur_['General']['name']; ?></h1>
				<h2 class="text-uppercase wow zoomInDown" data-wow-delay="0.6s"><?php echo $_Serveur_['General']['description']; ?></h2>
				<br>
				<a href="javascript:;" class="btn btn-circle js-scroll-trigger">
                	<i class="fa fa-angle-double-down animated"></i>
				</a>

            </div>
        </div>
		<div class="card card-parabellum text-xs-center">
            <div class="card-block text-center text-uppercase">
				IP du serveur : <?php echo '<b>'.$_Serveur_['General']['ipTexte'].'</b>'; ?> | <?php if($modeEnLigne == 0)
                {
                	echo '<span class="badge badge-danger">Hors-Ligne</span>'; 
                }
                else
                {
                	echo '<span class="badge badge-success">En Ligne</span> : '.$playeronline.' / '.$maxPlayers;
                }
                ?>
			</div>
		</div>
	</header>
	

    <!--Page-->
	<section id="about">
		<div class="container">
			<h1 class="text-uppercase"><?php echo $_Theme_['About']['main-title']; ?></h1>
			<h2><?php echo $_Theme_['About']['desc-top']; ?></h2>
			<div class="row">
				<div class="col-md-4 col-sm-12">
					<div class="about">
						<div class="about-circle"><i class="<?php echo $_Theme_['About']['icon1']; ?>"></i></div>
						<h4><?php echo $_Theme_['About']['title1']; ?></h4>
						<p><?php echo $_Theme_['About']['desc1']; ?></p>
					</div>
				</div>

				<div class="col-md-4 col-sm-12">
					<div class="about">
						<div class="about-circle"><i class="<?php echo $_Theme_['About']['icon2']; ?>"></i></div>
						<h4 class="card-text"><?php echo $_Theme_['About']['title2']; ?></h4>
						<p><?php echo $_Theme_['About']['desc2']; ?></p>
					</div>
				</div>

				<div class="col-md-4 col-sm-12">
					<div class="about">
						<div class="about-circle"><i class="<?php echo $_Theme_['About']['icon3']; ?>"></i></div>
						<h4 class="card-text"><?php echo $_Theme_['About']['title3']; ?></h4>
						<p><?php echo $_Theme_['About']['desc3']; ?></p>
					</div>
				</div>
			</div>

			<h3><span class="fas fa-angle-double-right"></span> <?php echo $_Theme_['About']['desc-bottom']; ?></h3>

		</div>
	</section>

    <section id="news">
        <div class="container">
			<h1 class="text-uppercase"><?php echo $_Theme_['News']['main-title']; ?></h1>
			<h2><?php echo $_Theme_['News']['desc-top']; ?></h2>
			<div class="row">
				
			<?php 
			$i = 0;
				if(isset($news) && count($news) > 0)
				{
					for($i = 0; $i < 5; $i++)
					{
						if($i < count($news))
						{
							$getCountCommentaires = $accueilNews->countCommentaires($news[$i]['id']);
							$countCommentaires = $getCountCommentaires->rowCount();

							$getcountLikesPlayers = $accueilNews->countLikesPlayers($news[$i]['id']);
							$countLikesPlayers = $getcountLikesPlayers->rowCount();
							$namesOfPlayers = $getcountLikesPlayers->fetchAll();

							$getNewsCommentaires = $accueilNews->newsCommentaires($news[$i]['id']);
							?>
							<div class="col-lg-12 col-md-12 col-sm-12">
								<button class="btn btn-news btn-block" type="button" data-toggle="collapse" data-target="#<?php echo $news[$i]['id']; ?>" aria-expanded="false" aria-controls="collapseExample">
									<div class="row">
										<div class="col-md-6 news-left">
											<h3><span class="badge badge-info" style="margin-right: 5px;">#<?php echo $news[$i]['id']; ?></span> <?php echo $news[$i]['titre']; ?></h3>
										</div>
										<div class="col-md-6 news-right">
											<?php echo 'Posté le '.date('d/m/Y', $news[$i]['date']); ?> <span style="margin-left: 15px;"></span> <img src="https://cravatar.eu/helmhead/<?php echo $news[$i]['auteur']; ?>/24" alt="auteur"/> <?php echo $news[$i]['auteur']; ?>
										</div>
									</div>
								
								</button>
								<div class="collapse" id="<?php echo $news[$i]['id']; ?>">
									<div class="card card-block">
										<p class="card-text"><?php echo $news[$i]['message']; ?></p>
										<?php
											if(isset($_Joueur_)) {
												$reqCheckLike = $accueilNews->checkLike($_Joueur_['pseudo'], $news[$i]['id']);
												$getCheckLike = $reqCheckLike->fetch();
												$checkLike = $getCheckLike['pseudo'];
												if($_Joueur_['pseudo'] == $checkLike) {
													echo '<a href="#" data-toggle="modal" data-target="#news'.$news[$i]['id'].'"><i class="fa fa-comment" aria-hidden="true"></i> '.$countCommentaires.' Commentaires</a>';
												} else {
													echo '<a href="?&action=likeNews&id_news='.$news[$i]['id'].'"><i class="fa fa-thumbs-up" aria-hidden="true"></i> J\'aime !</a> <a href="#" data-toggle="modal" data-target="#news'.$news[$i]['id'].'"><i class="fa fa-comment" aria-hidden="true"></i> '.$countCommentaires.' Commentaires</a>';
												}
												} else {
													echo '<a href="#" data-toggle="modal" data-target="#news'.$news[$i]['id'].'"><i class="fa fa-comment" aria-hidden="true"></i> '.$countCommentaires.' Commentaires</a>';
												}
											
												if($countLikesPlayers != 0) {
													echo '<a href="#" class="card-link"><i class="fa fa-thumbs-up"></i> '.$countLikesPlayers;
													//foreach ($namesOfPlayers as $likesPlayers) {
													//	echo $likesPlayers['pseudo'];
													//}
													echo '</a>';
												}
										?>
									</div>
								</div>
							</div>
							<?php if(isset($_Joueur_)) {
										$getNewsCommentaires = $accueilNews->newsCommentaires($news[$i]['id']);
										while($newsComments = $getNewsCommentaires->fetch()) {
											$reqEditCommentaire = $accueilNews->editCommentaire($newsComments['pseudo'], $news[$i]['id'], $newsComments['id']);
											$getEditCommentaire = $reqEditCommentaire->fetch();
											$editCommentaire = $getEditCommentaire['commentaire'];
											if($newsComments['pseudo'] == $_Joueur_['pseudo'] OR $_Joueur_['rang'] == 1) {  ?>
												<div class="modal fade" id="news<?php echo $news[$i]['id'].'-'.$newsComments['id'].'-edit'; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
													<div class="modal-dialog modal-support">
														<div class="modal-content modal-lg">
															<div class="modal-header">
																<center><h4 class="modal-title" id="myModalLabel"><b>Edition du commentaire</b></h4></center>
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															</div>
															<form action="?&action=edit_news_commentaire&id_news=<?php echo $news[$i]['id'].'&auteur='.$newsComments['pseudo'].'&id_comm='.$newsComments['id']; ?>" method="post">
																<div class="modal-body">
																	<textarea name="edit_commentaire" class="form-control" rows="3" style="resize: none;" maxlength="255" required><?php echo $editCommentaire; ?></textarea>
																</div>
																<div class="modal-footer">
																	<h4>Minimum de 6 caractères<br>Maximum de 255 caractères</h4></br>
																	<center><button type="submit" class="btn btn-parabellumW btn-block">Valider la modification</button></center>
																</div>
															</form>
														</div>
													</div><!-- /.modal-content -->
												</div><!-- /.modal-dialog -->
												<?php }
											}
										} ?>
									<div class="modal fade" id="<?php echo "news".$news[$i]['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-support">
										<div class="modal-content modal-lg">
											<div class="modal-header">
												<h4 class="modal-title" id="myModalLabel"><b><?php echo $news[$i]['titre']; ?></b></h4>
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											</div> <!-- Modal-Header -->
											<div class="modal-body">
											</br>
											<?php
											$getNewsCommentaires = $accueilNews->newsCommentaires($news[$i]['id']);
											while($newsComments = $getNewsCommentaires->fetch()) {
												if(isset($_Joueur_)) {
													
													$getCheckReport = $accueilNews->checkReport($_Joueur_['pseudo'], $newsComments['pseudo'], $news[$i]['id'], $newsComments['id']);
													$checkReport = $getCheckReport->rowCount();

													$getCountReportsVictimes = $accueilNews->countReportsVictimes($newsComments['pseudo'], $news[$i]['id'], $newsComments['id']);
													$countReportsVictimes = $getCountReportsVictimes->rowCount();
												}
												?>

												<div class="container">
													<div class="row">
															<div class="col-md-4 col-lg-4 col-sm-12">
																<p class="username"><img src="https://cravatar.eu/helmhead/<?php echo $_Joueur_['pseudo']; ?>/20" style="margin-left: -10px"></img><?php echo '<B> '.$newsComments['pseudo'].'</B>'; ?><br/>
																	<?php echo 'Le '.date('d/m', $newsComments['date_post']).' à '.date('H:i:s', $newsComments['date_post']).''; ?></p>
																<?php if(isset($_Joueur_)) { ?>
																	<span style="color: red;"><?php if($newsComments['nbrEdit'] != "0"){echo 'Nombre d\'édition: '.$newsComments['nbrEdit'].'';}if($countReportsVictimes != "0"){echo '<B>'.$countReportsVictimes.' Signalement</B> |';} ?></span>
																	<div class="dropdown">
																		<button class="btn btn-info" data-toggle="dropdown" style="font-size: 10px;">Action <b class="caret"></b></button>
																		<ul class="dropdown-menu">
																			<?php if($newsComments['pseudo'] == $_Joueur_['pseudo'] OR $_Joueur_['rang'] == 1) {
																				echo '<li><a href="#" data-toggle="modal" data-target="#news'.$news[$i]['id'].'-'.$newsComments['id'].'-edit">Editer</a></li>';
																				echo '<li><a href="?&action=delete_news_commentaire&id_comm='.$newsComments['id'].'&id_news='.$news[$i]['id'].'&auteur='.$newsComments['pseudo'].'">Supprimer</a></li>';
																			}
																			if($newsComments['pseudo'] != $_Joueur_['pseudo']) {
																				if($checkReport == "0") {
																					echo '<li><a href="?&action=report_news_commentaire&id_news='.$news[$i]['id'].'&id_comm='.$newsComments['id'].'&victime='.$newsComments['pseudo'].'">Signaler</a></li>';
																				} else {
																					echo '<li><a href="#">Déjà report</a></li>';
																				}
																			} ?><br>
																		</ul>
																	</div> <!-- dropdown -->
																	<?php } ?>
															</div>
															<div class="col-md-6 col-lg-6 col-sm-12">
																<?php $com = espacement($newsComments['commentaire']); echo BBCode($com, $bddConnection); ?>
															</div>
													</div> <!-- Ticket-Commentaire-->
												</div> <!-- Panel Panel-Default -->
													<?php } ?>
											</div> <!-- Modal-Body -->
												<?php
												if(isset($_Joueur_)) { ?>
													<div class="modal-footer w-100">
														<form action="?&action=post_news_commentaire&id_news=<?php echo $news[$i]['id']; ?>" method="post" class="w-100">
															<textarea name="commentaire" class="form-control w-100" required></textarea>
															<br><h4>Minimum de 6 caractères<br>Maximum de 255 caractères</h4>
														</br>
														<center><button type="submit" class="btn btn-parabellumW btn-block">Commenter</button></center>
														</form>
													</div>
											</div> <!-- Modal-Footer -->
											<?php } else { ?>
												<div class="modal-footer">
													<center><div class="alert alert-danger">Veuillez-vous connecter pour mettre un commentaire.</div></center>
													<center><a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-danger">Connexion</a></center>
												</div> <!-- Modal-Footer -->
												<?php } ?>
											</div> <!-- Modal-Content -->
								</div>

									<?php }  }
								}
									else
										echo '<div class="col-md-12 col-lg-12 col-sm-12"><div class="alert alert-warning"><p class="text-center">Aucune news n\'a été créée à ce jour...</p><br><br><br><br><br><br><br><br></div></div>'; ?>
				</div>				
			</div>
		</div>
	</section>
	
	<section id="staff">
		<div class="container">
			<h1 class="text-uppercase"><?php echo $_Theme_['Staff']['main-title']; ?></h1>
			<h2><?php echo $_Theme_['Staff']['desc-top']; ?></h2>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<button class="btn btn-staff btn-block" type="button" data-toggle="collapse" data-target="#Staff" aria-expanded="false" aria-controls="collapseExample">
						<h4>Cliquez pour afficher</h4>
					</button>

					<div class="collapse" id="Staff">
						<div class="card card-block">
							<div class="row">

								<?php
								$staff = 1;

								while ($staff <= $_Theme_['Staff']['number'])
								{
									echo '<div class="col-md-3 col-sm-4 col-6">';
									echo '<div class="card staff-card">';
									echo '<img class="card-img-top" src="http://cravatar.eu/helmhead/' . $_Theme_['Staff']['name' . $staff . ''] . '/600.png" alt="staff-img">';
									echo '<div class="card-body">';
									echo '<h3 class="card-title">' . $_Theme_['Staff']['name'. $staff . ''] . '</h3>';
									echo '<p class="card-text">' . $_Theme_['Staff']['grade'. $staff . ''] . '</p>';
									echo '</div>';
									echo '</div>';
									echo '</div>';
									$staff++;
								}
								?>

						</div>
					</div>
				</div>
								<div class="collapse" id="<?php echo $news[$i]['id']; ?>">
									<div class="card card-block">
										<p class="card-text"><?php echo $news[$i]['message']; ?></p>
										
									</div>
								</div>
							</div>


	</section>