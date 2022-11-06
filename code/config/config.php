<?php
$rep = __DIR__ . '/../';
$erreur = '';

//BD
$login = 'root';
$mdp = "";
$dsn = 'mysql:host=localhost;port=3307;dbname=startyourproject;charset=utf8';




//Vues
$bootstrapCSS = 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css';
$bootstrapJS = 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js';
$bootstrapJquery = 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js';
$bootstrapJava = 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js';

$images['imageAccueil1'] = 'vues/media/tache.PNG';
$images['imageAccueil2'] = 'vues/media/Ptut.PNG';
$images['logo'] = 'vues/media/ImageLogo.png';
$images['logo2'] = 'vues/media/logo2.png';
$images['mesProjets'] = 'vues/media/projet.png';
$images['carousel'] = 'vues/media/bleu.jpg';


$vues['pageErreur'] = 'vues/pageErreur.php';
$vues['pageAccueil'] = 'vues/pageAccueil.php';
$vues['pageConnexion'] = 'vues/pageConnexion.php';
$vues['pageMesProjets'] = 'vues/pageMesProjets.php';
$vues['pageProjet'] = 'vues/pageProjet.php';
$vues['pageCreationTache'] = 'vues/pageCreationTache.php';
$vues['pageCreationProjet'] = 'vues/pageCreationProjet.php';
$vues['pageMenu'] = 'vues/pageMenu.php';
$vues['inscription'] = 'vues/pageInscription.php';
$vues['messagerie'] = 'vues/pageMessagerie.php';

$body = '<body>
    <table width="100%" style="background-color: black;">
        <td align="center">
            <img src="https://nsa40.casimages.com/img/2021/04/01/210401120947172470.png" style="height: 50%;"/>                
        </td>
    </table>
    <table align="center" style="margin-top: 10px;">
        <td align="center">
            <span style="font-size: 30px; font-family: Arial Black;" >
                <strong>Bienvenue !</strong>
            </span>
        </td>
    </table>
    <table width="100%">
        <td align="center">
            <p style="font-family: Arial;">
    Vous êtes désormais inscris sur notre outil de gestion StartYourProject.<br>
Vous pouvez dès à présent créer votre projet ou en rejoindre un !<br>
            </p>
        </td>
    </table>
</body>';