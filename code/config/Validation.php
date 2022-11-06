<?php


class Validation
{

    /** Permet la validation de la connexion
     * @param string $email email reçu
     * @param string $mdp mot de passe reçu
     * @return mixed retourne un tableau contenant les erreurs
     */
    public static function ValidationConnexion(string $email, string $mdp)
    {

        if (!isset($email) || $email == "") { //Si l'email est null ou vide
            $Vueerreur[] = "il n'y pas de login";
        }

        if (!self::ValidationMail($email)) //Teste si l'email est sous une bonne forme
        {
            $Vueerreur[] = "Vous avez rentré votre email avec des caractères invalides";
        }

        if (!isset($mdp) || $mdp == "") { //Si le mot de passe est null ou vide
            $Vueerreur[] = "il n'y a pas de mot de passe ";
        }

        return $Vueerreur;

    }

    /** Permet la validation d'un STRING
     * @param string $val valeur reçue
     * @return bool
     */
    public static function ValidationString(string $val): bool
    {

        $val = Nettoyage::NettoyageString($val);

        if (!isset($val) or empty($val)) {
            return false;
        } else return true;
    }

    /**
     * Permet la validation d'un INT
     * @param int $nb nombre reçu
     * @return bool
     */
    public static function ValidationInt(int $nb): bool
    {
        $nb = Nettoyage::NettoyageInt($nb);

        if (!isset($nb) or empty($nb))
            return false;

        if (filter_var($nb, FILTER_VALIDATE_INT)) {
            return true;
        }

        return false;
    }

    /** Permet la validation d'un EMAIL
     * @param string $email email reçu
     * @return bool
     */
    public static function ValidationMail(string $email): bool
    {
        $email = Nettoyage::NettoyageEmail($email);

        if (!isset($email) or empty($email))
            return false;

        if ($email == filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        return false;

    }

    /** Permet la validation d'un BOOL
     * @param bool $boolean boolean reçu
     * @return bool
     */
    public static function ValidationBoolean(bool $boolean): bool
    {
        if (!isset($boolean) or empty($boolean))
            return false;


        if (filter_var($boolean, FILTER_VALIDATE_BOOLEAN)) {
            return true;
        }

        return false;

    }


}