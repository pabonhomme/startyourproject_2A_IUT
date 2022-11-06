<?php


class ChefProjetControleur
{
    function __construct()
    {
        global $rep, $vues, $erreur;
        try {
            if (isset($_REQUEST["action"])) {
                $action = $_REQUEST["action"];
            } else {
                $action = NULL;
            }
            switch ($action) {
                case "SupprimerProjet" :
                    $this->supprimerProjet();
                    break;
                case "TerminerProjet" :
                    $this->terminerProjet();
                    break;
                default:
                    throw new Exception('Action incorrecte');
            }
        } catch (PDOException $e) {
            $erreur = "Erreur PDO";
            require($rep . $vues['pageErreur']);
        } catch (Exception $e2) {
            $erreur = "Erreur";
            require($rep . $vues['pageErreur']);
        }
    }

    /**
     * Permet de supprimer un projet
     */
    private function supprimerProjet(): void
    {
        $idProjet = $_REQUEST['idProjet'];
        if (isset($idProjet)) {
            ModelProjet::deleteProjet($idProjet);
            header('Refresh:0;url=index.php?action=AfficherPageMesProjets');
        }
    }

    /**
     * Permet de terminer un projet
     */
    private function terminerProjet(): void
    {
        $idProjet = $_REQUEST['idProjet'];
        if (isset($idProjet)) {
            ModelProjet::terminerProjet($idProjet);
            header('Refresh:0;url=index.php?action=AfficherPageMesProjets');
        }
    }
}