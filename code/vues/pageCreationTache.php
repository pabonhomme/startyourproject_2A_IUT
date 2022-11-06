<!DOCTYPE html>
<head>
    <meta charset="utf-8"/>
    <title>Start Your Project</title>

    <link href="vues/css/style.css" rel="stylesheet"/>
    <!-- CSS BOOTSTRAP -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <script src="vues/js/creerTache.js" type="text/javascript "></script>

</head>
<body>
<header>
    <a href="index.php"><img src="vues/media/ImageLogo.png"></a>
    <nav>
        <ul class="nav_lien">
            <li><a href="index.php?action=AfficherPageMesProjets">MesProjets</a></li>
            <li><a href="#">Aide</a></li>
            <li><a href="#">Crédit</a></li>
        </ul>
    </nav>
    <?php
    if ($isUtilisateur) {
        ?>
        <a class="btn btn-primary rounded-pill boutonnav" href="index.php?action=Deconnecter">Se deconnecter</a>
        <?php
    } else { ?>
        <a class="btn btn-primary rounded-pill boutonnav" href="index.php?action=AfficherConnexion">Se connecter</a>
        <?php
    }
    ?>
</header>

<div class="container card mt-5 p-3" id="size-container">
    <h1 class="mb-3 text-center">Créez une tâche</h1>
    <div class="form-group mb-3 mx-auto">
        <form onsubmit="creer_tache()" id="form" method="post">
            <input name="nomtache" id="nomtache" class="form-control mt-3 mb-3" placeholder="Nom de la tâche" required autofocus />
            <input type="hidden" id="idprojet" name="idProjet" class="form-control mt-3 mb-3" value="<?php echo $idProjet;?>">
            <div id="container">
                <div class="form-inline">
                    <input name="mailMembre[]" id="mailMembre" class="form-control" onfocusout="membre(this)" required placeholder="Membre de la tâche">
                    <a href="#" id="ajouter" class="ml-2 " onclick="ajout()">Ajouter</a>
                </div>
                <span  id="erreur " style="color: red"></span><span  id="ok1"></span>
            </div>
            <input name="description" id="description" placeholder="Description de la tâche" id="" class="form-control mt-3 mb-3" required />
            <input name="cout" id="cout" class="form-control mt-3 mb-3" placeholder="Coût de la tâche" required/>
            <input type="date" id="datedebut" name="datedebut" required placeholder="Date de début"  class="form-control mt-3 mb-3"/>
            <input name="duree" placeholder="Durée" id="duree" class="form-control mt-3 mb-3" required />
            <input class="btn btn-primary" id="submit" value="Créer une tâche" type="submit" required/>
        </form>
    </div>
</div>
</body