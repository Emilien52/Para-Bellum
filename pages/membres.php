<?php
// Initialisation des membres
$Membres = new MembresPage($bddConnection);
if (isset($_GET['page_membre'])) {
    $page = htmlentities($_GET['page_membre']);
    $membres = $Membres->getMembres($page);
} else {
    $page = 1;
    $membres = $Membres->getMembres();
}
?>
<section class="layout" id="white">
    <div class="container">
        <h1 class="titre text-uppercase"><span class="fa fa-user"></span> Membres</h1>
    </div>
</section>

<section class="layout" id="page">
    <div class="container">
        <div class="info-container">
            <h3><strong><i class="fas fa-users"></i> Liste Des Membres</strong></h3>
            <p>Ici, vous pourrez consulter la liste des membres du site, voir leur profil ...</p>
        </div>
        <br>
        <br>
        <?php
        $Membres = new MembresPage($bddConnection);
        if (isset($_GET['page_membre'])) {
            $page = htmlentities($_GET['page_membre']);
            $membres = $Membres->getMembres($page);
        } else {
            $page = 1;
            $membres = $Membres->getMembres();
        }
        ?>

        <div class="p-1 bg-light rounded rounded-pill shadow-sm mb-4">
            <div class="input-group" style="margin-bottom: 8px">

                <input onChange="rechercheAjaxMembre();" type="text" placeholder="Ex: Teyir ( Appuyez sur Entrée pour valider )" aria-describedby="button-addon1" class="form-control border-0 bg-light" id="recherche" name="searchPlayer">
                <div class="input-group-append">
                    <button id="button-addon1" type="submit" class="btn btn-link text-primary"><i class="fa fa-search"></i></button>
                </div>
            </div>

        </div>
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Pseudo</th>
                <th scope="col">Grade Site</th>
                <th scope="col"><?=$_Serveur_['General']['moneyName'];?></th>
                <th scope="col">Actions</th>
            </tr>
            </thead>

            <tbody id="tableMembre" class="text-white">
            <?php foreach ($membres as $value) : ?>
                <tr>
                    <td scope="row">
                        <?= $value['id']; ?></td>
                    <td>
                        <img src='<?= $_ImgProfil_->getUrlHeadByPseudo($value['pseudo'], 32); ?>' style='width: 32px; height: 32px;' alt='image de profile de <?= $value["pseudo"] ?>' /> <?= $value["pseudo"]; ?>
                    </td>

                    <td>
                        <?= Permission::getInstance()->gradeJoueur($value["pseudo"]); ?>
                    </td>

                    <td>
                        <?= $value['tokens']; ?>
                    </td>

                    <td>
                        <a href="?page=profil&profil=<?= $value['pseudo']; ?>" class="btn btn-reverse">Voir le compte</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>

        </table>

        <br>

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php if ($page > 1)
                    echo '<li class="page-item">
		      <a class="page-link" href="?page=membres&page_membre=' . ($page - 1) . '" aria-label="Précédente">
		        <span aria-hidden="true">&laquo;</span>
		        <span class="sr-only">Précédente</span>
		      </a>
		    </li>';
                for ($i = 1; $i <= $Membres->nbPages; $i++) {
                    ?><li class="page-item"><a class="page-link" href="?page=membres&page_membre=<?= $i; ?>"><?= $i; ?></a></li><?php
                }
                if ($page < $Membres->nbPages)
                    echo '<li class="page-item">
		      <a class="page-link" href="?page=membres&page_membre=' . ($page + 1) . '" aria-label="Suivante">
		        <span aria-hidden="true">&raquo;</span>
		        <span class="sr-only">Suivante</span>
		      </a>
		    </li>';
                ?>
            </ul>
        </nav>
    </div>
</section>
<script>
    function rechercheAjaxMembre() {
        $("#tableMembre").html("<img src='theme/<?= $_Serveur_['General']['theme']; ?>/img/gif-search.gif'>Recherche en cours ...");
        $.ajax({
            url: 'index.php?action=rechercheMembre',
            type: 'POST',
            data: 'ajax=true&recherche=' + $('#recherche').val(),
            success: function(code, statut) {
                $("#tableMembre").html(code);
            }
        });
    }
</script>
