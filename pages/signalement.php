<?php // Vérification des perms
if (Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'seeSignalement')) :
    $req = $bddConnection->query('SELECT * FROM cmw_forum_report WHERE vu = 0');
    $nbr_signalement = 0 //COmpter le nombre de signalement
    
?>
<style>
.color-red{color: var(--color-main) !important; }
</style>
<section class="layout" id="white">
	<div class="container">
		<h1 class="titre text-uppercase"><span class="fas fa-angle-double-right"></span> Signalement</h1>
	</div>
</section>
<section class="layout" id="page">
	<div class="container">
		<h4 class="title">Gestion des signalements</h4>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Type de report</th>
				<th>Raison</th>
				<th>Reporteur</th>
				<th>Lien</th>
			</tr>
		</thead>
		<tbody>
		<?php while ($data = $req->fetch(PDO::FETCH_ASSOC)) :
			$nbr_signalement++; ?>

			<tr>
				<td>
					<?= ($data['type'] == 0) ? 'Topic' : 'Réponse' ?>
				</td>
				<td>
					<?= $data['reason']; ?>
				</td>
				<td>
					<?= $data['reporteur']; ?>
				</td>
				<td>
					<?php if ($data['type'] != 0) :
						//Affichage de la réposne 
						$req_topic = $bddConnection->prepare('SELECT * FROM cmw_forum_answer WHERE id = :id');
						$req_topic->execute(array(
							'id' => $data['id_topic_answer']
						));

						$id = $req_topic->fetch(PDO::FETCH_ASSOC);

						$req_page = $bddConnection->prepare('SELECT * FROM cmw_forum_answer WHERE id_topic = :id');
						$req_page->execute(array(
							'id' => $id['id_topic']
						));
						$d_page = $req_page->fetchAll(PDO::FETCH_ASSOC);


						foreach ($d_page as $key => $value) :
							if ($d_page[$key]['id'] == $data['id_topic_answer']) {
								$ligne = $key;
							}
						endforeach;

						$ligne++;

						$tour = 1;
						unset($d);
						unset($page);

						while ($d != TRUE) :

							$nb = 20 * $tour;
							if ($nb >= $ligne) :
								$page = $tour;
								$d = TRUE;
							else :
								$tour++;
							endif;

						endwhile; ?>


						<a href="index.php?action=r_a_vu&id_a=<?= $data['id_topic_answer']; ?>&id=<?= $id['id_topic']; ?>&page_post=<?= $page; ?>">
							Lien vers la réponse
						</a>

					<?php else : ?>

						<a href="index.php?action=r_t_vu&id=<?= $data['id_topic_answer']; ?>">Voir le topic</a>

					<?php endif; ?>
				</td>
			</tr>
		<?php endwhile; ?>

		<?php if ($nbr_signalement == 0) : //Si il n'y a aucun signelement ?>
			<tr class="p-0 no-hover">
				<td colspan="4" class="p-0 no-hover">
					<div class="m-0 info-page bg-white">
						<div class="text-center color-red">Aucun signalement actuellement !</div>
					</div>
				</td>
			</tr>
		<?php endif; ?>
		</tbody>
		<caption style="color:#fff">
			Nombre de signalements : <?= $nbr_signalement ?>
		</caption>
	</table>
</section>
<?php
else :
    //Redirection à une page d'erreur si l'utilisateur n'a pas les droits.
    header('Location: index.php?page=erreur&erreur=12');
endif;
?>