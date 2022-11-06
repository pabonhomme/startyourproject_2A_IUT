<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Start Your Project</title>

    <!-- CSS Bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


    <link href="vues/css/style.css" rel="stylesheet">
    <link href="vues/css/pageProjet.css" rel="stylesheet">


    <!--ICONS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

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

    <a class="btn btn-primary rounded-pill boutonnav" href="index.php?action=Deconnecter">Se deconnecter</a>

</header>
<div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar">
        <div class="sidebar-sticky pt-3" id="fond">
            <ul class="nav flex-column ml-3">
                <li class="nav-item bg-warning m-1 sidebarMenuLien">
                    <a class="nav-link active bouton boutonOrange" href="index.php?action=AfficherPageMesProjets">
                        <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                        Mes projets<span class="sr-only">(current)</span>
                    </a>
                </li>
                <?php if (!$projet->getEstTermine()) { ?>
                    <li class="nav-item bg-warning m-1 sidebarMenuLien">
                        <a class="nav-link bouton boutonOrange"
                           href="index.php?action=AffichePageCreationTache&idProjet=<?php echo $projet->getIdProjet() ?>">
                            Créer Tache
                        </a>
                    </li>
                <?php } ?>
                <li class="nav-item bg-warning m-1 sidebarMenuLien">
                    <a class="nav-link bouton boutonOrange"
                       href="index.php?action=Messagerie&idProjet=<?php echo $projet->getIdProjet() ?>">
                        Conversation
                    </a>
                </li>
                <?php if ($isChefProjet && !$projet->getEstTermine()) { ?>
                    <li class="nav-item bg-success mt-5 sidebarMenuLien">
                        <a class="nav-link bouton" id="boutonTerminee"
                           href="index.php?action=TerminerProjet&idProjet=<?php echo $projet->getIdProjet() ?>">
                            Terminer le projet
                        </a>
                    </li>
                <?php }
                if ($isChefProjet) { ?>
                    <li class="nav-item bg-danger mt-3 sidebarMenuLien">
                        <a class="nav-link bouton" id="boutonSupprimer"
                           href="index.php?action=SupprimerProjet&idProjet=<?php echo $projet->getIdProjet() ?>">
                            Supprimer
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
    <a class="bg-warning mt-4 rounded m-2 p-1" id="btn-changeWeek" href="index.php?action=AfficherPageProjet&numeroSemaine=<?php echo $numeroSemaine -1?>&idprojet=<?php echo $projet->getIdProjet() ?>">
        <img class="taille-img" id="reverse" src="vues/media/fleche.png"/>
    </a>
    <a class="bg-warning mt-4 rounded m-2 p-1" id="btn-changeWeek" href="index.php?action=AfficherPageProjet&numeroSemaine=<?php echo $numeroSemaine +1?>&idprojet=<?php echo $projet->getIdProjet() ?>">
        <img class="taille-img" src="vues/media/fleche.png"/>
    </a>
    <div class="col-sm">
        <div class="text-center">
            <?php if ($prixAllTaches > $projet->getBudget()) { ?>
                <pre class="text-danger lead">Coût du projet : <?php echo $prixAllTaches ?>€ pour un budget de <?php echo $projet->getBudget() ?>€</pre>
            <?php } else { ?>
                <pre class="text-success lead">Coût du projet : <?php echo $prixAllTaches ?>€ pour un budget de <?php echo $projet->getBudget() ?>€</pre>
            <?php } ?>
        </div>
        <div class="  mb-3 row ml-1 text-white mt-3 p-1  align-middle" id="calendar">
            <div class="col border border-white bg-dark rounded text-center ">
                <p>Lundi</p>
                <p><?php echo $tabJours[1]?></p>
            </div>
            <div class="col border border-white bg-dark rounded text-center ">
                <p>Mardi</p>
                <p><?php echo $tabJours[2]?></p>
            </div>
            <div class="col border border-white bg-dark rounded text-center ">
                <p>Mercredi</p>
                <p><?php echo $tabJours[3]?></p>
            </div>
            <div class="col border border-white bg-dark rounded text-center ">
                <p>Jeudi</p>
                <p><?php echo $tabJours[4]?></p>
            </div>
            <div class="col border border-white bg-dark rounded text-center ">
                <p>Vendredi</p>
                <p><?php echo $tabJours[5]?></p>
            </div>
        </div>
        <?php
        foreach ($projet->getListeTaches() as $tache) {
            $id = $tache->settingAffichage($numeroSemaine);
            if (isset($id) && !empty($id)) {?>
                    <div class="infos  <?php echo $id ?> mt-3">
                        <div class="border border-dark rounded text-white <?php echo $tache->randomColor() ?> tache p-2">
                            <?php echo ucfirst($tache->getNomTache()); ?>
                        </div>
                        <div class="detailTache bg-dark text-white rounded p-3">
                            <p>
                                <?php echo $tache->getDureeRest(strtotime(date("Y-m-d H:i:s")), strtotime(date("Y-m-d H:i:s"))) . " jours restants" ?>
                            </p>
                            <p>
                                <i class="fa fa-users" aria-hidden="true"></i>
                                Membres de la tache : <?php echo $tache->getListeMembres() ?>
                            </p>
                            <p>
                                <i class="fa fa-tag" aria-hidden="true"></i>
                                Description : <?php echo ucfirst($tache->getDescription()); ?>
                            </p>
                        </div>
                    </div>

                <?php
            }
            ?>


        <?php }
        ?>
        <table class="table" id="tableMembres">
            <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Rôle</th>
            </tr>
            </thead>
            <?php
            foreach ($projet->getListeUtilisateur() as $utilisateur) { ?>
            <tbody>
            <tr>
                <td>
                    <i class="fa fa-user-circle-o" id="iconMembre"></i>
                    <?php echo ucfirst($utilisateur->getNom());
                    echo " ";
                    echo ucfirst( $utilisateur->getPrenom())
                    ?>
                </td>
                <td><?php echo ucfirst($utilisateur->getRole());
                    ?></td>
            </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</div>
</html>