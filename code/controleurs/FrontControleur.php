<?php

class FrontControleur
{


    public function __construct()
    {
        global $rep, $vues;
        header("Content-Security-Policy: style-src https://maxcdn.bootstrapcdn.com 'self'");
        header("X-Frame-Options: deny");
        header("X-Content-Type-Options: nosniff");
        header("X-XSS-Protection: 1; mode=block");
        session_start();

            $listeActions = array(
                'VisiteurControleur' => array(NULL, 'AfficherConnexion','SeConnecter', 'AfficherInscription', 'Inscription'),
                'UtilisateurControleur' => array('Deconnecter', 'AfficherPageMesProjets', 'CreerTache' , 'AfficherPageProjet', 'AjouterProjet', 'AfficherPageCreationProjet', 'AffichePageCreationTache', 'Messagerie', 'AjouterMembreTache', "AfficherErreur"),
                'ChefEquipeControleur' => array(''),
                'ChefProjetControleur' => array('SupprimerProjet', 'TerminerProjet'));

            $utilisateur = ModelUtilisateur::isUtilisateur();
            if (isset($_REQUEST["action"])) {
                $action = $_REQUEST["action"];
            }
            else {
                $action = NULL;
            }

           $ctrl = $this->rechAction($listeActions, $action, $utilisateur);

            if (!isset($ctrl)) {
                $Vueerreur[] = "Action inconnue";
                require($rep . $vues['pageErreur']);
                exit(1);
            }

            new $ctrl;

        }


    /**
     * Permet de récupérer une action voulue dans le tableau d'action
     * @param array $listeActions liste des actions possibles
     * @param string $action action voulue
     * @param bool $isUtilisateur true si utilisateur connecté, false sinon
     * @return int|string|null
     */
    public function rechAction(array $listeActions, $action, bool $isUtilisateur)
    {
        global $rep, $vues;
        foreach ($listeActions as $key => $value) {
            if (in_array($action, $value)) {
                if ($key == 'UtilisateurControleur') {
                    if (!$isUtilisateur) {
                        require($rep.$vues['pageConnexion']);
                    }
                }
                return $key;
            }
        }
        return NULL;
    }
}