<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Start Your Project</title>

    <!-- CSS Bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="vues/css/connexion.css">
    <link href="vues/css/style.css" rel="stylesheet">

</head>


<body class="text-center" id="img-background">
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

    <?php
    if (isset($data) && !empty($data)) { ?>
        <div class="alert alert-warning div-alert-inscription-perso" role="alert" style="text-align: center">
            <?php foreach ($data as $d) {
                echo $d;
            } ?>
        </div>
        <?php
    }
    ?>

    <div class="container card mt-5 p-3" id="size-container">
        <h1 class="mb-3">Connectez-vous</h1>
        <div class="form-group mb-3 mx-auto">
            <form action="index.php?action=SeConnecter" method="post">
                <input type="email" class="form-control mt-3 mb-3" placeholder="Adresse email" required autofocus
                       name="email">
                <input type="password" class="form-control mt-3 mb-3" placeholder="Mot de passe" required name="mdp">
                <button class="btn btn-primary" type="submit">Me connecter</button>
            </form>
        </div>
        <div>
            <a id="creer" href="index.php?action=AfficherInscription"> Pas de compte ? Créez en un !</a>
        </div>
    </div>
</div>
</body>