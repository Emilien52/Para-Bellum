<?php if (count($jsonCon) > 0) {
    require('modele/app/chat.class.php');
    $Chat = new Chat($jsonCon);
}
?>
<section class="layout" id="white">
		<div class="container">
			<h1 class="titre text-uppercase"><span class="fas fa-ban"></span> Ban-list</h1>
		</div>
</section>
<section class="layout" id="page">
	<div class="container text-white">		
		<h3 class="header-bloc">Liste des joueurs bannis</h3>
		<?php if(count($jsonCon) > 0) { ?>
			<ul class="nav nav-tabs" style="margin-bottom:1vh;">
			<?php for($i = 0; $i < count($jsonCon); $i++) {?>
				<li class="nav-item">
					<a href="#serv_<?= $i ?>" data-toggle="tab" class="nav-link <?php if($i == 0) echo 'active'; ?>"><?php echo $lectureJSON[$i]['nom']; ?></a>
				</li>
			<?php }?>
			</ul>
			
			<div class="tab-content">
				<?php for($i=0; $i < count($jsonCon); $i++) {
?>
				<div id="serv_<?=$i?>" class="tab-pane fade <?php if($i==0) echo 'in active show'; ?>" aria-expanded="false">
					<table class="table table-bordered">
						<tr>
							<th>Pseudo</th>
							<th>Date</th>
							<th>Source</th>
							<th>Durée</th>
							<th>Raison</th>
						</tr>
						<?php 
						foreach($banlist[$i] as $element) {?>
						<tr>
							<td title="<?= $element->uuid?>"><?= $element->name?></td>
							<td><?= $element->created ?></td>
							<td><?= $Chat->formattage($element->source); ?></td>
							<td><?= $element->expires ?></td>
							<td><?= $element->reason ?></td>
						</tr>
						<?php }?>
					</table>
				</div>
				<?php }?>
			</div>
		<?php } else { ?>
			<div class="tab-pane fade in show" aria-expanded="false">
                <div class="info-page bg-danger">
                    <div class="text-center p-3">
                        Aucun serveur n'a été enregistré !
                    </div>
                </div>
            </div>
		<?php } ?>
	</div>
</section>