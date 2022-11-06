<!DOCTYPE html>
<head>
    <meta charset="utf-8"/>
    <title>Start Your Project</title>

    <link href="vues/css/accueil.css" rel="stylesheet"/>
    <link href="vues/css/style.css" rel="stylesheet">
    <!-- CSS BOOTSTRAP -->
    <link rel="stylesheet" href="<?php echo $bootstrapCSS; ?>"/>

    <!-- jQuery BOOTSTRAP -->
    <script src="<?php echo $bootstrapJquery; ?>"></script>

    <!-- Popper JS BOOTSTRAP -->
    <script src="<?php echo $bootstrapJS; ?>"></script>

    <!-- JavaScript BOOTSTRAP -->
    <script src="<?php echo $bootstrapJava; ?>"></script>
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

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="<?php echo $images['carousel']; ?>">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="vues/media/bleu.jpg">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </a>
    </div>


    <?php if (!$isUtilisateur) { ?>
        <a id="CommencerButton" class="btn" href="index.php?action=AfficherInscription" type="button">Commencer un projet</a>
    <?php } ?>


    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center" id="titrePrincipal">Bienvenue sur StartYourProject !</h1>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-6">
                <img class="img-fluid border rounded bg-white" id="img-logo" src="<?php echo $images['logo2']; ?>">
                <figcaption>
                    <h3 class="text-center">Quel est ce site ?</h3>
                    <p> Ce site se nomme StartYourProject. Il permet la création et la gestion de projets.
                </figcaption>
            </div>
            <div class="col-md-6">
                <img class="img-fluid border rounded" src="<?php echo $images['mesProjets']; ?>">
                <figcaption>
                    <h3 class="text-center">Comment ?</h3>
                    <p> Cliquer sur le bouton en haut à gauche du site pour créer un projet et découvrir les
                        fonctionnalités.</p>
                </figcaption>
            </div>
        </div>
    </div>


    <div class="container MarginTop">
        <div class="row TextAccroche">
            <div class="col-md-8">
                <img class="img-fluid border circle-rounded" src="<?php echo $images['imageAccueil1']; ?>">
            </div>
            <div class="col-md-4">
                <h3>Organisation rapide</h3>
                <p>Grâce à notre application, vous pouvez organiser vos tâches simplement et rapidement.</p>
            </div>
        </div>
    </div>

    <div class="container MarginTop">
        <div class="row TextAccroche">
            <div class="col-md-4">
                <h3>Système efficace</h3>
                <p>Notre système est conçu pour gérer vos projets de manière efficace et facile.</p>
            </div>
            <div class="col-md-8">
                <img class="img-fluid border rounded" src="<?php echo $images['imageAccueil2']; ?>">
            </div>
        </div>
    </div>

    <div class="MarginTop">
        <div class="row no-padding">
            <div class="col-md-6">
                <div class="embed-responsive embed-responsive-16by9 Video">
                    <iframe width="1280" height="699" src="https://www.youtube.com/embed/cDaEYYWG6U4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-md-6 bg-dark" id="TextVideo">
                <h2 class="text-center">Que propose le site ?</h2>
                <p id="paragrapheVideo">Notre site permet une création et une gestion de projet simple et efficace. En effet, plusieurs fonctionnalités sont à votre disposition : </p>
                <p>  - Créer un projet et ajouter un nombre indéfini de personnes à celui-ci, si ces personnes ne sont pas inscrites, pas de soucis, elles seront inscrites automatiquement lors de leur ajout et un mail leur sera envoyé pour les prévenir qu'elles ont été ajoutés à un projet</p>
                <p>  - Afficher vos projets triés en fonction de divers critères pour améliorer la clarté </p>
                <p>  - Afficher les détails d'un projet permettant de voir le nombre de tâches, leurs dates, les personnes associées à celles-ci </p>
                <p>  - Créer une tâche avec le même fonctionnement que la création de projet </p>
                <p>  - Une messagerie interne permettant de communiquer directement avec les membres de votre projet</p>

                <h3 class="text-center">N'attendez plus !</h3>
            </div>
        </div>
    </div>
    <footer class="footer">
        @StartYourProject
    </footer>
</div>
</body>

