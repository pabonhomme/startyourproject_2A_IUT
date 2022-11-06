<?php

/**
 * classe contenant les fonctions pour un projet
 * Class ModelListeTaches
 */
class ModelProjet
{

    /**
     * Permet de récupérer un projet en fonction d'un idProjet
     * @param int $idProjet id du projet
     * @return Projet
     */
    static function getProjetbyID( $idProjet)
    {
        global $dsn, $login, $mdp;
        $gateway = new ProjetGateway(new Connexion($dsn, $login, $mdp));
        $result = $gateway->getProjetbyID($idProjet);
        return new Projet($result['idProjet'], $result['nomProjet'], $result['estTermine'], $result['budget']);
    }

    /**
     * Permet de récupérer les projets propres à un utilisateur
     * @param string $email pseudo de l'utilisateur
     * @return array
     */
    static function getAllProjetsByMail(string $email, string $tri): array
    {
        global $dsn, $login, $mdp;
        $tabP = array();
        $gateway = new ProjetGateway(new Connexion($dsn, $login, $mdp));
        $results = $gateway->getAllProjetsByMail($email, $tri);
        foreach ($results as $row) {
            $tabP[] =  new Projet($row['idProjet'], $row['nomProjet'], $row['estTermine'], $row['budget']);
        }
        return $tabP;
    }

    /**
     * Permet d'ajouter un projet dans la base de données
     * @param $nomprojet // nom du projet
     * @param $mail // mail user
     * @param $description // description du projet
     * @param $budget // budget du projet
     */
    static function ajouterProjet(string $nomprojet, string $mail, string $description, float $budget, string $date) :int
    {
        global $dsn, $login, $mdp;
        $gateway = new ProjetGateway(new Connexion($dsn, $login, $mdp));
        return $gateway->ajouterProjet($nomprojet, $mail, $description, $budget, $date);
    }

    /**
     * Permet d'ajouter un membre à un projet
     * @param string $membre pseudo du membre àa jouter
     * @param int $idProjet id du projet
     */
    static function ajouterMembre(string $membre, int $idProjet)
    {
        global $dsn, $login, $mdp;
        $gateway = new ProjetGateway(new Connexion($dsn, $login, $mdp));
        $gateway->ajouterMembre($membre, $idProjet);
    }

    /**
     * Permet de supprimer un projet et ses tâches associées
     * @param int $idProjet id du projet à supprimer
     */
    static function deleteProjet(int $idProjet): void
    {
        global $dsn, $login, $mdp;
        $gateway = new ProjetGateway(new Connexion($dsn, $login, $mdp));
        ModelTache::deleteTachesByIdProjet($idProjet); // suppression de toutes les tâches du projet
        $gateway->deleteProjet($idProjet); // suppression du projet
    }

    /**
     * Permet de récupérer le nombre de projets
     * @return int
     */
    static function nbProjet(): int
    {
        global $dsn, $login, $mdp;
        $gateway = new ProjetGateway(new Connexion($dsn, $login, $mdp));
        $results = $gateway->nbProjet();
        return $results[0]["count(*)"];
    }

    /**
     * Permet de mettre un projet sur l'état terminé
     * @param int $idProjet id du projet à modifier
     */
    public static function terminerProjet(int $idProjet): void
    {
        global $dsn, $login, $mdp;
        $gateway = new ProjetGateway(new Connexion($dsn, $login, $mdp));
        $gateway->terminerProjet($idProjet);
    }



}