<?php 

if(isset($_Joueur_) AND isset($_POST['id_answer']))
{
	$id = htmlspecialchars($_POST['id_answer']);
	$req = $bddConnection->prepare('SELECT contenue FROM cmw_forum_answer WHERE id = :id');
	$req->execute(array(
		'id' => $id
	));
	$donnee = $req->fetch();
	?>
	<section class="layout" id="white">
		<div class="container">
			<h1 class="titre text-uppercase"><span class="far fa-comments"></span> Forum / Edition d'une réponse</h1>
		</div>
	</section>
<section class="layout" id="page"><form action="?action=edit_answer" method="POST">
	<div class="container">
		<h4 class="title" style="text-transform: uppercase;">Edition d'une réponse</h4><br>
		<input type="hidden" name="id_answer" value="<?php echo $id; ?>"/>
		<label for="contenue" class="control-label">Editez votre réponse</label><br/>
		<textarea name="contenue" maxlength="10000" class="form-control" id="contenue"><?php echo $donnee['contenue']; ?></textarea>
		<br><button type="submit" class="btn btn-parabellum pull-right">Envoyer</button>
      </div>
	  </form></section>
      <?php 
}
else
	header('Location: ?page=erreur&erreur=0');
