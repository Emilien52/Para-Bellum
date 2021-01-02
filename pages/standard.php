 <?php 
if(!empty($pages['titre']) && !empty($pageContenu[$j][0])){
	header('Location: ?page=erreur&erreur=8000000'); exit();
}
?>
<section class="layout" id="white">
	<div class="container">
		<h1 class="titre text-uppercase"><?= $pages['titre']; ?></h1>
	</div>
</section>
<section class="layout" id="page">
    <div class="container text-white">
		<div class="info-container text-center">
			<h3><strong><?php for ($j = 0; $j < count($pages['tableauPages']); $j++){ echo $pageContenu[$j][0]; } ?></strong></h3>
		</div>
		<br>
		
		
        <div class="row">
            <div class="col-sm-12">
                    <?php for ($j = 0; $j < count($pages['tableauPages']); $j++) : ?>
                        <div><?= $pageContenu[$j][1]; ?></div>
                    <?php endfor; ?>
            </div>
        </div>

    </div>
</section>