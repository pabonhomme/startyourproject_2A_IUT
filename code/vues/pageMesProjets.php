<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Start Your Project</title>

    <!-- CSS Bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!--CSS -->
    <link href="vues/css/style.css" rel="stylesheet">
    <link href="vues/css/pageMesprojet.css" rel="stylesheet">

    <script src="vues/js/tri.js" type="text/javascript "></script>

</head>

<body class="bg-white">
<header>
    <a href="index.php"><img src="vues/media/ImageLogo.png"></a>
    <nav>
        <ul class="nav_lien">
            <li><a href="index.php?action=AfficherPageMesProjets">MesProjets</a></li>
            <li><a href="#">Aide</a></li>
            <li><a href="#">Crédit</a></li>
        </ul>
    </nav>

    <a class="btn btn-primary rounded-pill boutonnav" href="index.php?action=Deconnecter">Se deconnecter</a>
</header>
<h2 class="m-5">Mes projets :</h2>
<div class="row justify-content-start ml-3">
    <div class="col-1">
        <form name="formTri" method="post" action="index.php?action=AfficherPageMesProjets">
            <select id="selectTri" name="triSelect" class="custom-select ml-3" onchange="triDynamique()">
                <option value="">Tri...</option>
                <option value="A-Z">A-Z</option>
                <option value="Z-A">Z-A</option>
                <!--            <option value="Date">Date</option>-->
                <!--            <option value="Favoris">Favoris</option>-->
            </select>
    </form>
    </div>
    <div class="col-2">
        <a href="index.php?action=AfficherPageCreationProjet" class="btn btn-primary rounded-pill">Nouveau projet</a>
    </div>
</div>
<div class="ml-5 p-3 row justify-content-start">
    <?php
    $i = 0;
    foreach ($tabProjets as $projet) {
        if (!$projet->getEstTermine()) {
            if ($i == 8) {
                $i = 0;
                echo "</div><div class=\"ml-5 p-3 row justify-content-start\">";
            } ?>
            <div class="col-1 ml-5">
                <form action="index.php?action=AfficherPageProjet" method="post">
                    <input type="hidden" name="idprojet" value="<?php echo $projet->getIdProjet() ?>">
                    <Button class="btn border-primary" id="sizeProjet" type="submit">
                        <img src="vues/media/logo-projet.png" width="100%"/>
                        <?php echo ucfirst($projet->getNomProjet()); ?>
                        <br>
                        <span class="badge badge-warning" id="badge-projet">En cours</span>
                    </Button>
                </form>
            </div>
            <?php $i++;
        }
    }
    ?>
</div>

<hr>

<div class="d-inline-flex ml-5 mt-3">
    <h2>Mes projets terminés:</h2>
</div>
<div class="ml-5 p-3 row justify-content-start">
    <?php
    $i = 0;
    foreach ($tabProjets as $projet) {
        if ($projet->getEstTermine()) {
            if ($i == 8) {
                $i = 0;
                echo "</div><div class=\"ml-5 p-3 row justify-content-start\">";
            } ?>
            <div class="col-1 ml-5">
                <form action="index.php?action=AfficherPageProjet" method="post">
                    <input type="hidden" name="idprojet" value="<?php echo $projet->getIdProjet() ?>">
                    <Button class="btn border-primary" id="sizeProjet" type="submit">
                        <img src="vues/media/logo-projet.png" width="100%"/>
                        <?php echo ucfirst($projet->getNomProjet()); ?>
                        <br>
                        <span class="badge badge-success" id="badge-projet">Terminé</span>
                    </Button>
                </form>
            </div>
            <?php $i++;
        }
    }
    ?>
</div>

</body>
</html>