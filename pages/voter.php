<section class="layout" id="white">
		<div class="container">
			<h1 class="titre text-uppercase"><span class="fas fa-calendar-alt"></span> Voter</h1>
		</div>
</section>
<section class="layout" id="page">
<div class="container">
				<?php
				if(isset($_GET['erreur']))
				{
					if($_GET['erreur'] == 1)
					{
						?><div class="alert alert-primary">Vous devez encore attendre <?php echo $_GET['time']; ?> avant de pouvoir voter sur ce site !<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a><script>$(".alert").alert()</script></div><?php
					}
					if($_GET['erreur'] == 2)
					{
						?><div class="alert alert-primary">Vous devez vous connecter si vous voulez gagner une récompense...<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a><script>$(".alert").alert()</script></div><?php
					}
				}
				elseif(isset($_GET['success']))
				{
					?><div class="alert alert-success">Votre récompense arrive, si vous n'avez pas vu de fenêtre s'ouvrir pour voter, la fenêtre à dû s'ouvrir derrière votre navigateur, validez le vote et profitez de votre récompense In-Game !<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a><script>$(".alert").alert()</script></div><?php
				}
				?>	

<div class="panel panel-primary">
	<div class="info-container">
		<h3><strong><span class="fas fa-info-circle"></span> <?php echo $_Serveur_['General']['name']; ?> a besoin de vous !</strong></h3>
		<p>

		Voter pour le serveur permet d'améliorer son référencement ! Les votes sont récompensés par des items In-Game.<br /><?php if(!isset($_Joueur_)) echo '<hr><a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-warning btn-lg" ><span class="glyphicon glyphicon-user"></span> Veuillez vous connecter.</a>'; ?>
		</p>
  </div>
</div>
<br>

			<h4 class="header-bloc">Sélectionnez le serveur sur lequel vous voulez voter :</h3>
			<div class="tabbable">
				<form action="?&action=voter" method="post">
				<ul class="nav nav-tabs" style="margin-bottom:1vh;">
                
				<?php 
                if(!isset($jsonCon) OR empty($jsonCon))
                    echo '<p>Veuillez relier votre serveur à votre site avec JsonAPI depuis le panel pour avoir les liens de vote !</p>';
                
                for($i = 0; $i < count($jsonCon); $i++) { ?>
					
					<li class="nav-item"><a class="btn btn-parabellum" href="#voter<?php echo $i; ?>" data-toggle="tab" class="nav-link <?php if($i == 0) echo ' active'; ?>"><?php echo $lecture['Json'][$i]['nom']; ?></a></li>
					
				<?php } ?>
				</ul>
				
				<?php if(isset($_Joueur_))
				{ ?>
				<div class="tab-content">
				<?php for($i = 0; $i < count($jsonCon); $i++) { ?>
				
					<div id="voter<?php echo $i; ?>" class="tab-pane fade <?php if($i==0) echo 'in active show';?>" <?php if($i == 0) { echo 'aria-expanded="true"'; } else echo 'aria-expanded="false"'; ?>>  
						<div class="panel-body">
						<hr>
                    
					<?php  $req_vote->execute(array('serveur' => $i));
							$count_req->execute(array('serveur' => $i));
							$data_count = $count_req->fetch();
							if($data_count['count'] > 0)
							{
								while($liensVotes = $req_vote->fetch())
								{
									?>
										<button type="submit" class="btn btn-parabellum bouton-vote" name="site" value="<?php echo $liensVotes['id']; ?>" onclick="window.open('<?php echo $liensVotes['lien']; ?>','Fiche','toolbar=no,status=no,width=1350 ,height=900,scrollbars=yes,location=no,resize=yes,menubar=yes')" >
											<?php echo $liensVotes['titre']; ?>
				                        </button>					
								<?php								
								}
							}
							else
								echo '</br><p>Aucun lien de vote n\'est disponible pour ce serveur...</p>';
                    ?>
					
					</div>
				</div>
				
				<?php } ?>
				</div>
				<?php
			}
			else
				{
					?><center>
		<h4>Veuillez vous connecter pour accéder à la boutique:</h4>
		<a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-warning btn-lg" ><span class="glyphicon glyphicon-user"></span> Connexion</a>
		</center><?php
				} ?>				
				</form>				
				
			</div>
			<br/>	

			<h3 class="header-bloc">Top voteurs</h3>
			<div class="corp-bloc">

				<table class="table table-hover">

					<thead>
						<tr><th>#</th><th>Pseudo</th><th>Votes</th></tr>
					</thead>
				
						<?php for($i = 0; $i < count($topVoteurs) AND $i < 10; $i++) { ?>
						<tr><td><?php echo $i ?></td><td><img src="http://cravatar.eu/helmavatar/<?=$topVoteurs[$i]['pseudo'];?>&size=30" alt="none" /> <strong><?php echo $topVoteurs[$i]['pseudo']; ?></strong></td><td><?php echo $topVoteurs[$i]['nbre_votes']; ?></td></tr>
						<?php }?>
				</table>
			</div>
</div>
</section>
