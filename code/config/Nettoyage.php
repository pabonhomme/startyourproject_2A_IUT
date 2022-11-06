<?php

/**
 * Contient les différentes méthodes de nettoyage
 * Class Nettoyage
 */
class Nettoyage
{
    /**
     * Permet le nettoyage d'un string
     * @param string $val valeur à nettoyer
     * @return mixed
     */
    public static function NettoyageString(string $val)
    {
        return filter_var($val, FILTER_SANITIZE_STRING);

    }

    /**
     * Permet le nettoyage d'un int
     * @param int $val valeur à nettoyer
     * @return mixed
     */
    public static function NettoyageInt(int $val)
    {
        return filter_var($val, FILTER_SANITIZE_NUMBER_INT);

    }

    /**
     * Permet le nettoyage d'un email
     * @param string $email valeur à nettoyer
     * @return mixed
     */
    public static function NettoyageEmail(string $email)
    {
        return filter_var($email, FILTER_SANITIZE_EMAIL);

    }


}