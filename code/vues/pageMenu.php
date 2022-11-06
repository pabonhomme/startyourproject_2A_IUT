<!DOCTYPE html>
<head>
    <meta charset="utf-8"/>
    <title>Start Your Project</title>

    <link href="vues/css/Accueil.css" rel="stylesheet"/>
    <!-- CSS BOOTSTRAP -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="vues/js/loadpage.js" type="text/javascript "></script>
</head>

<body>
<div class="Contenu">
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

    <div class="content"></div>

