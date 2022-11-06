<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Start Your Project</title>

    <!-- CSS Bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="vues/css/inscription.css">
    <link href="vues/css/style.css" rel="stylesheet">

</head>
<body class="text-center" id="img-background">
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
<header>
    <a href="index.php"><img src="vues/media/ImageLogo.png"></a>
    <nav>
        <ul class="nav_lien">
            <li><a href="index.php?action=AfficherPageMesProjets">MesProjets</a></li>
            <li><a href="#">Aide</a></li>
            <li><a href="#">Crédit</a></li>
        </ul>
    </nav>
    <a class="btn btn-primary rounded-pill boutonnav" href="index.php?action=AfficherConnexion">Se connecter</a>

</header>


<div class="container card mt-5 p-3" id="size-container">
    <h1 class="mb-3">Inscrivez-vous</h1>
    <div class="form-group mb-3 mx-auto">
        <form action="index.php?action=Inscription" method="post">
            <input id="email" type="email" class="form-control mt-3 mb-3" placeholder="Adresse email" value="<?php if(isset($_GET['email'])) echo $_GET['email'];?>" required autofocus
                   name="email">
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <input class="form-control" placeholder="Prenom" required name="prenom" value="<?php if(isset($_GET['prenom'])) echo $_GET['prenom'];?>">
                </div>
                <div>
                    <input id="name" class="form-control" placeholder="Nom" required name="nom" value="<?php if(isset($_GET['nom'])) echo $_GET['nom'];?>">
                </div>
            </div>
            <input type="password" class="form-control mt-3 mb-3" placeholder="Mot de passe" required name="mdp">
            <input type="password" class="form-control mt-3 mb-3" placeholder="Entrez à nouveau votre mot de passe"
                   required name="mdpVerify">
            <button class="btn btn-primary" type="submit">S'inscrire</button>
        </form>
    </div>
</div>
</body>