<section class="layout" id="white">
    <div class="container">
        <h1 class="titre text-uppercase"><span class="fas fa-angle-double-right"></span>
        <?php if($pages['titre'] == "" && $pageContenu[$j][0] == ""){
            echo 'Erreur !';
        } else {
            echo $pages['titre'];
        } ?>
        </h1>
    </div>
</section>
<section class="layout" id="page">
    <div class="container">
    <?php if($pages['titre'] == "" && $pageContenu[$j][0] == ""){ ?>
    <style>
    .error-template {padding: 40px 15px;text-align: center;}
    .error-actions {margin-top:15px;margin-bottom:15px;}
    .error-actions .btn { margin-right:10px; }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="error-template">
                    <h1>
                        Oups!</h1>
                    <h2>
                        Erreur 404</h2>
                    <div class="error-details">
                        Désolé mais la page demandé est introuvable ! :(
                    </div>
                    <div class="error-actions">
                        <a href="index.php" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-home"></span>
                            Retourner sur l'accueil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } else { ?>
    <?php } ?>
    			<?php for($j = 0; $j < count($pages['tableauPages']); $j++) { ?>
    				<strong><h2><?php echo $pageContenu[$j][0]; ?></h2></strong>
    				<div><?php echo $pageContenu[$j][1]; ?></div>
    			<?php } ?>
    </div>
</section>