<?php


class ModelChefProjet
{
    /**
     * Permet de vérifier si un utilisateur est chef de projet sur un projet donné
     * @param int $idProjet id du projet à vérifier
     * @param string $email email de l'utilisateur à vérifier
     * @return bool true si chef, non sinon
     */
    public static function isChefProjet(int $idProjet, string $email): bool
    {
        global $dsn, $login, $mdp;
        $gateway = new UtilisateurGateway(new Connexion($dsn, $login, $mdp));
        return $gateway->isChefProjet($idProjet, $email);
    }
}