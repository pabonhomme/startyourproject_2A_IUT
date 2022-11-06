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
    <link href="vues/css/pageMessagerie.css" rel="stylesheet">

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-app.js"></script>

    <!--on inclus la base de données -->
    <script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-database.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
         https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-analytics.js"></script>

    <script src="vues/js/messagerie.js" type="text/javascript "></script>

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

<div>
    <h1 class="m-5 text-center">Messagerie</h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 mb-5 content-conversation">
            <ul id="messages"></ul>
            <form class="form-floating position-absolute w-100 pt-5 pb-2 pr-3 pl-3" id="input-Message"
                  onsubmit="return envoyerMessage();">
                <div class="input-group">
                    <input type="hidden" id="email" name="email" value="<?php echo $_SESSION['email'] ?>">
                    <input type="hidden" id="prenom" name="prenom" value="<?php echo $utilisateur->getPrenom() ?>">
                    <input type="hidden" id="nom" name="nom" value="<?php echo $utilisateur->getNom() ?>">
                    <input type="hidden" id="idProjet" name="idProjet" value="<?php echo $projet->getIdProjet() ?>">
                    <?php if ($projet->getEstTermine()) { ?>
                        <input type="text" class="form-control" placeholder="Ecrivez votre message..." id="message">
                    <?php } else { ?>
                        <input type="text" class="form-control" placeholder="Ecrivez votre message..." id="message">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="submit">Envoyer</button>
                        </div>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
</div>

</body>

