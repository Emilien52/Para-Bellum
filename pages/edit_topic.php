<?php 

if(isset($_Joueur_) AND isset($_POST['id_topic']))
{
	$id = htmlspecialchars($_POST['id_topic']);
	$req = $bddConnection->prepare('SELECT * FROM cmw_forum_post WHERE id = :id');
	$req->execute(array(
		'id' => $id
	));
	$donnee = $req->fetch();
	?>
	<section class="layout" id="white">
		<div class="container">
			<h1 class="titre text-uppercase"><span class="far fa-comments"></span> Forum / Edition d'un topic</h1>
		</div>
	</section>
	<section class="layout" id="page"><form action="?action=edit_topic" method="POST">
	<div class="container">
		<h4 class="title" style="text-transform: uppercase;">Edition d'un topic</h4><br>
        <input type="hidden" name="id_topic" value="<?php echo $id; ?>"/>
        <label for="contenue" class="control-label">Editez votre contenu</label><br/>
        <textarea name="contenue" maxlength="10000" class="form-control" id="contenue"><?php echo $donnee['contenue']; ?></textarea>
        <hr>
        <button type="submit" class="btn btn-parabellum pull-right">Envoyer</button>
      </div>
	  </form></section>
      <?php 
}
else
	header('Location: ?page=erreur&erreur=0');