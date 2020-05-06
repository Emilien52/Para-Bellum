<section class="layout" id="white">
		<div class="container">
			<h1 class="titre text-uppercase"><span class="fa fa-user-md"></span> Support communautaire</h1>
		</div>
</section>
<section class="layout" id="page">
<div class="container">
	<div class="info-container">
		<h3><strong><span class="fas fa-info-circle"></span> Comment ça marche ?</strong></h3>
		<p>Postez des tickets, lisez ceux des autres, répondez à la communauté et discutez avec l'équipe du serveur !</p>
	</div>
	<br>
		<div class="white-container">
				<table class="table table-bordered">
					<thead class="thead-inverse bg-parabellum">
						<tr>
							<?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsDefault']['support']['displayTicket'] == true) { echo '<th style="text-align: center;">Visuel</th>'; } ?>
							<th style="text-align: center;">Pseudo</th>
							<th style="text-align: center;">Titre</th>
							<th style="text-align: center;">Date</th>
							<th style="text-align: center;">Action</th>
                            <th style="text-align: center;">Status </th>
							<?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsDefault']['support']['closeTicket'] == true) { echo '<th style="text-align: center;">Modification</th>'; } ?>
						</tr>
					</thead>
					<tbody>
					<?php $j = 0;
					while($tickets = $ticketReq->fetch()) { ?>
						<tr>
						    <?php if($tickets['ticketDisplay'] == 0 OR $tickets['auteur'] == $_Joueur_['pseudo'] OR $_Joueur_['rang'] == 1 OR $_PGrades_['PermsDefault']['support']['displayTicket'] == true) {
						    if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsDefault']['support']['displayTicket'] == true) { ?>
						    <td class="align-middle">
						        <?php if($tickets['ticketDisplay'] == "0") {
						                echo '<center><span><i class="fas fa-eye"></i> Public</span></center>';
						            } else {
								        echo '<center><span ><i class="fas fa-eye-slash"></i> Privé</span></center>';
								} ?>
							</td>
							<?php } ?>

							<td class="text-center align-middle">
								<a href="index.php?&page=profil&profil=<?php echo $tickets['auteur'] ?>" style="color: #d82c2e;"><img class="icon-player-topbar" src="https://cravatar.eu/helmhead/<?php echo $tickets['auteur']; ?>/32" /> <?php echo $tickets['auteur'] ?></a>
							</td>
						
							<td class="text-center align-middle">
								<?php echo $tickets['titre'] ?>​
							</td>
						
							<td class="text-center align-middle">
								<?php echo $tickets['jour']. '/' .$tickets['mois']. ' à ' .$tickets['heure']. ':' .$tickets['minute']; ?>
							</td>
						
							<td class="text-center align-middle">
								<a class="btn btn-info btn-sm" data-toggle="modal" href="#" data-target="#<?php echo $tickets['id']; ?>Slide">
									Voir <i style="color: #fff;" class="fa fa-eye"></i>
								</a>
							</td>
                            
                            <td class="text-center align-middle">
                                <?php
                                    $ticketstatus = $tickets['etat'];
                                    if($ticketstatus == "1"){
                                        echo '<button class="btn btn-success">Résolu <span class="glyphicon glyphicon-ok"></span></button>';
                                    } else {
                                        echo '<button class="btn btn-warning">Non Résolu <span class="glyphicon glyphicon-remove"></span></button>';
                                    }
                                ?>
                            </td>

							<?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsDefault']['support']['closeTicket'] == true) { ?>
								<td style="text-align: center;">
									<form class="form-horizontal default-form" method="post" action="?&action=ticketEtat&id=<?php echo $tickets['id']; ?>">
										<?php if($tickets['etat'] == 0){ 
											echo '<button type="submit" name="etat" class="btn btn-warning" value="1" />Fermer le ticket</button>';
										}else{
											echo '<button type="submit" name="etat" class="btn btn-warning" value="0" />Ouvrir le ticket</button>';
										} ?>
									</form>
								</td>
							<?php }
							} ?>
						</tr>
						
					<?php if($tickets['ticketDisplay'] == "0" OR $tickets['auteur'] == $_Joueur_['pseudo'] OR $_Joueur_['rang'] == 1 OR $_PGrades_['PermsDefault']['support']['displayTicket'] == true) { ?>
					<!-- Modal -->
					<div class="modal fade" id="<?php echo $tickets['id']; ?>Slide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-support">
							<div class="modal-content">
							
								<div class="modal-header">
                                <?php
                                    $ticketstatus = $tickets['etat'];
                                    if($ticketstatus == "1"){
                                        echo '<span class="badge badge-success" style="color: white; margin-right: 10px; font-size: 23px;">Résolu !</span>';
                                    } else {
                                        echo '';
                                    }
								?>
									<h4 class="modal-title" id="myModalLabel" style="color: white;" ><b><?php echo $tickets['titre']; ?></b></h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								
								<div class="modal-body">
									<p class="corp-ticket" style="text-overflow: clip; word-wrap: break-word;"><?php 
									unset($message);
									$message = espacement($tickets['message']);
									$message = BBCode($message, $bddConnection);
									echo $message; ?></p>
									<p class="text-right">Ticket de : <img src="https://cravatar.eu/helmhead/<?php echo $tickets['auteur']; ?>/16" alt="none" /> <?php echo $tickets['auteur']; ?></p>
									<hr>
									
									<?php
									$commentaires = 0;
									if(isset($ticketCommentaires[$tickets['id']]))
									{
										echo '<h3 class="ticket-commentaire-titre" style="color: #d82c2e;">' .count($ticketCommentaires[$tickets['id']]). ' Commentaires</h3>';
										for($i = 0; $i < count($ticketCommentaires[$tickets['id']]); $i++)
										{
											$get_idComm = $bddConnection->prepare('SELECT id FROM cmw_support_commentaires WHERE auteur LIKE :auteur AND id_ticket LIKE :id_ticket');
											$get_idComm->bindParam(':auteur', $ticketCommentaires[$tickets['id']][$i]['auteur']);
											$get_idComm->bindParam(':id_ticket', $tickets['id']);
											$get_idComm->execute();
											$req_idComm = $get_idComm->fetch();
									?>
									<div class="panel panel-default">
										<div class="panel-body">
    										<div class="ticket-commentaire">
											<div class="left-ticket-commentaire">
												<span class="img-ticket-commentaire"><img src="https://cravatar.eu/helmhead/<?php echo $ticketCommentaires[$tickets['id']][$i]['auteur']; ?>/32" alt="none" /></span>
												<span class="desc-ticket-commentaire">
													<span class="ticket-commentaire-auteur"><?php echo $ticketCommentaires[$tickets['id']][$i]['auteur']; ?></span>
													<span class="ticket-commentaire-date"><?php echo 'Le ' .$ticketCommentaires[$tickets['id']][$i]['jour']. '/' .$ticketCommentaires[$tickets['id']][$i]['mois']. ' à ' .$ticketCommentaires[$tickets['id']][$i]['heure']. ':' .$ticketCommentaires[$tickets['id']][$i]['minute']; ?></span>
													<?php if(isset($_Joueur_) && (($ticketCommentaires[$tickets['id']][$i]['auteur'] == $_Joueur_['pseudo'] OR $_Joueur_['rang'] == 1 OR $_PGrades_['PermsDefault']['support']['deleteMemberComm'] == true) OR ($ticketCommentaires[$tickets['id']][$i]['auteur'] == $_Joueur_['pseudo'] OR $_Joueur_['rang'] == 1 OR $_PGrades_['PermsDefault']['support']['editMemberComm'] == true))) { ?>
							                             <span class="dropdown" style="padding-left: 40%">
								                                <a class="btn btn-info collapsed" data-toggle="dropdown">Action <b class="caret"></b></a>
								                                <ul class="dropdown-menu">
									                                <?php if($ticketCommentaires[$tickets['id']][$i]['auteur'] == $_Joueur_['pseudo'] OR $_Joueur_['rang'] == 1 OR $_PGrades_['PermsDefault']['support']['deleteMemberComm'] == true) {
										                                echo '<li><a class="text-muted" href="?&action=delete_support_commentaire&id_comm='.$req_idComm['id'].'&id_ticket='.$tickets['id'].'&auteur='.$ticketCommentaires[$tickets['id']][$i]['auteur'].'"> Supprimer</a></li>';
									                                } if($ticketCommentaires[$tickets['id']][$i]['auteur'] == $_Joueur_['pseudo'] OR $_Joueur_['rang'] == 1 OR $_PGrades_['PermsDefault']['support']['editMemberComm'] == true) {
									                                	echo '<li><a class="text-muted" href="#editComm-'.$req_idComm['id'].'" data-toggle="modal" data-target="#editComm-'.$req_idComm['id'].'" > Editer</a></li>';
									                                }?>
								                                </ul>
							                             </span>
						                            <?php } ?>
												</span>
												
											</div>
											<div class="right-ticket-commentaire"><div style="text-overflow: clip; word-wrap: break-word;">
												<?php unset($message);
												$message = espacement($ticketCommentaires[$tickets['id']][$i]['message']);
												$message = BBCode($message, $bddConnection);
												echo $message;  ?></div>
											</div>
										</div>
									</div>
									
									

									<?php
										}
									}		
									else
										echo '<h3 style="color: #d82c2e;" class="ticket-commentaire-titre">0 Commentaire</h3>';
									?>
									
									
									
								</div>
								<?php
								if($tickets['etat'] == "0"){
									echo '<form action="?&action=post_ticket_commentaire" method="post"><div class="modal-footer">
												<input type="hidden" name="id" value="'.$tickets['id'].'" /><div class="row">';
												?>
											</div><div class="col-md-12">
												<textarea name="message" id="ticket<?=$tickets['id'];?>" class="form-control" rows="3" cols="60"></textarea>
												</div></div>
												<div class="col-md-12">
												<button type="submit" class="btn btn-parabellumW" style="margin-bottom: 40px;">Commenter</button>
												</div>
										  </div>
											</form>
											<?php 
								} else {
									echo '<div class="modal-footer">
											<form action="" method="post">
												<textarea style="text-align: center;"name="message" class="form-control" rows="2" placeholder="Ticket résolu ! Merci de contacter un administrateur pour réouvrir votre ticket." disabled></textarea>
											</form>
										  </div>';
								}
								?>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->

					<?php if($ticketCommentaires[$tickets['id']][$i]['auteur'] == $_Joueur_['pseudo'] OR $_Joueur_['rang'] == 1 OR $_PGrades_['PermsDefault']['support']['editMemberComm'] == true) {
						for($i = 0; $i < count($ticketCommentaires[$tickets['id']]); $i++) {
							$get_idComm = $bddConnection->prepare('SELECT id FROM cmw_support_commentaires WHERE auteur LIKE :auteur AND id_ticket LIKE :id_ticket');
							$get_idComm->bindParam(':auteur', $ticketCommentaires[$tickets['id']][$i]['auteur']);
							$get_idComm->bindParam(':id_ticket', $tickets['id']);
							$get_idComm->execute();
							$req_idComm = $get_idComm->fetch(); ?>
					<div class="modal fade" id="editComm-<?php echo $req_idComm['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editComm">
					    <form method="POST" action="?&action=edit_support_commentaire&id_comm=<?php echo $req_idComm['id']; ?>&id_ticket=<?php echo $tickets['id']; ?>&auteur=<?php echo $ticketCommentaires[$tickets['id']][$i]['auteur']; ?>">
				        <div class="modal-dialog modal-lg" role="document">
					        <div class="modal-content">
						        <div class="modal-header">
									<h4 class="modal-title text-center" id="editComm"><b>Edition du commentaire</b></h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        </div>
						        <div class="modal-body">
						            <div class="col-lg-12 text-center">
						            	<div class="row">
						            		<textarea name="editMessage" class="form-control" rows="3" style="resize: none;"><?php echo $ticketCommentaires[$tickets['id']][$i]['message']; ?></textarea>
						            	</div>
						            </div>
						        </div>
						        <div class="modal-footer">
						        	<div class="col-lg-12 text-center">
						        		<div class="row">
						        			<button type="submit" class="btn btn-parabellum">Valider !</button>
						        		</div>
						        	</div>
						        </div>
						    </div>
						</div>
						</form>
				    </div>
				    <?php }
				       }
				    }
					$j++; } ?>
					</tbody>
			</table>
			<?php
					if(!isset($_Joueur_)) 
						echo '<a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-warning btn-block" ><span class="glyphicon glyphicon-user"></span> Se connecter pour ouvrir un ticket</a>'; 
					else 
					{
				?>
				<a data-toggle="collapse" data-parent="#ticketCree" href="#ticketCree" class="btn btn-parabellumW"><i class="fa fa-pencil-square-o"></i> Poster un ticket !</a>
	</div>
		  </div>
				<br>
			<div class="container">
				<div class="collapse" id="ticketCree">
					<div class="white-container">
						<form action="" method="post" onSubmit="envoie_ticket();">
								<div class="row">
									<div class="col-sm-8">
										<div class="form-group">
											<div class="input-group">
												<input type="text" id="titre_ticket" class="form-control" name="titre" placeholder="Sujet">
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<select class="form-control" id="vu_ticket" name="ticketDisplay">
												<option class="text-muted" value="0">Publique</option>
												<option class="text-muted" value="1">Privée</option>
											</select>
										</div>
									</div>
								</div>
									<textarea class="form-control" id="message_ticket" name="message" placeholder="Description détaillée de votre problème" rows="3"></textarea>
									<br>
									<button type="submit" class="btn btn-success champ valider pull-right">Envoyer</button>
								</div>
						</form>
					</div>
				</div>
			</div>
				<?php } ?>
	</div>
</section>
<script>
var nbEnvoie = 0
	function envoie_ticket()
	{
		if(nbEnvoie>0)
			return false;
		else
		{
			var data_titre = document.getElementById("titre_ticket").value;
			var data_message = document.getElementById("message_ticket").value;
			var data_vu = document.getElementById("vu_ticket").value;
			$.ajax({
				url  : 'index.php?action=post_ticket',
				type : 'POST',
				data : 'titre=' + data_titre + '&message=' + data_message + '&ticketDisplay=' + data_vu,
				dataType: 'html'
			});
			nbEnvoie++;
			return true;
		}
	}
</script>