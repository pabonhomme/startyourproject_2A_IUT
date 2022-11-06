$(document).ready(function() {
    //par défaut on affiche la page projet
    $('.content').load('vues/pageAccueil.php');
    $('ul.nav_lien li a').click(function () {
        var affichage = $(this).attr('href');
        $('.content').load('vues/' + affichage + '.php');
        return false;
    });
    $('.accueil').click(function () {
        var affichage = $(this).attr('href');
        $('.content').load('vues/' + affichage + '.php');
        return false;
    });
});