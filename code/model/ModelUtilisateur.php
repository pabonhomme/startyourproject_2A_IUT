<?php


class ModelUtilisateur
{
    /**
     * Permet de savoir si un utilisateur est connecté
     * @return bool true si utilisateur existe, false sinon
     */
    public static function isUtilisateur(): bool
    {
        if (isset($_SESSION['role']) && isset($_SESSION['email'])) {
            if ($_SESSION['role'] == "utilisateur") {
                return true;
            }
        }
        return false;
    }

    /**
     * Permet à un utilisateur de se connecter
     * @param string $email email de l'utilisateur
     * @param string $motDePasse mot de passe de l'utilisateur
     * @return bool true si connexion réussi, false sinon
     */
    public static function connexion(string $email, string $motDePasse): bool
    {
        global $dsn, $login, $mdp;
        $gateway = new UtilisateurGateway(new Connexion($dsn, $login, $mdp));
        //$email = Nettoyage::NettoyageString($email);
        //$motDePasse = Nettoyage::NettoyageString($motDePasse);
        $result = $gateway->rechercherUtilisateur($email, $motDePasse);
        if ($result) {
            $_SESSION['role'] = "utilisateur";
            $_SESSION['email'] = $email;
            return true;
        }
        return false;
    }

    /**
     * Permet de savoir si un utilisateur existe avec son mail
     * @param string $email mail à vérifier
     */
    public static function rechercheUtilisateurByMail(string $email) {

        global $dsn, $login, $mdp;
        $gateway = new UtilisateurGateway(new Connexion($dsn, $login, $mdp));
        $result = $gateway->rechercherUtilisateurByMail($email);
        if($result != null){
            return new Utilisateur($result['email'], $result['nom'], $result['prenom'], $result['estRempli']);
        }
        return null;
    }

    /**
     * @param string $email email du membre à rechercher
     * @param int $idProjet idProjet à vérifier si l'utilisateur en est membre
     * @return bool membre existe ou non
     */
    public static function isMembreProjet(string $email, int $idProjet) : bool
    {
        global $dsn, $login, $mdp;
        $gateway = new UtilisateurGateway(new Connexion($dsn, $login, $mdp));
        return $gateway->rechercheMembreProjet($email, $idProjet);
    }

    /**
     * Permet d'inscrire un nouvel utilisateur
     * @param string $email email de l'utilisateur
     * @param string $nom nom de l'utilisateur
     * @param string $prenom prénom de l'utilisateur
     * @param string $mdpUser mot de passe de l'utilisateur
     * @param bool $estRempli true si inscription complète, false sinon
     */
    static function inscription(string $email, string $nom, string $prenom, string $mdpUser, bool $estRempli): void{
        global $dsn, $login, $mdp;
        $gateway = new UtilisateurGateway(new Connexion($dsn, $login, $mdp));
        $gateway->ajouterUtilisateur($email, $prenom, $nom, $mdpUser, $estRempli);
    }

    /**
     * Permet de récupérer la liste des utilisateurs associés à une tâche
     * @param int $idTache id de la tache à rechercher
     * @return |null
     */
    static function getAllUtilisateursByIdTache(int $idTache){
        global $dsn, $login, $mdp;
        $tab = array();
        $gateway = new UtilisateurGateway(new Connexion($dsn, $login, $mdp));
        $results = $gateway->getAllUtilisateursByIdTache($idTache);
        if($results != null){
            foreach ($results as $row){
                $tab[] = new Utilisateur($row['email'], $row['nom'], $row['prenom'], $row['estRempli']);
            }
        }
        return $tab;
    }

    /**
     * Permet de récupérer tous les membres d'un projet donné
     * @param int $idprojet id du projet à récupérer
     * @return array
     */
    public static function getAllMembresProjet(int $idprojet) : array
    {
        global $dsn, $login, $mdp;
        $membres = array();
        $gateway = new UtilisateurGateway(new Connexion($dsn, $login, $mdp));
        $results = $gateway->getAllMembresProjet($idprojet);
        foreach ($results as $membre) {
            $user = new Utilisateur($membre['email'],$membre['nom'], $membre['prenom'],  $membre['estRempli'] );
            $user->setRole($membre['role']);
            $membres[] = $user;

        }
        return $membres;
    }

    /**
     * Permet de modifier un utilisateur dans la base de données
     * @param string $email
     * @param string $nom
     * @param string $prenom
     * @param string $mdpUser
     * @param bool $estRempli
     */
    public static function modifierUtilisateur(string $email, string $nom, string $prenom, string $mdpUser, bool $estRempli){
        global $dsn, $login, $mdp;
        $gateway = new UtilisateurGateway(new Connexion($dsn, $login, $mdp));
        $gateway->modifierUtilisateur($email, $prenom, $nom, $mdpUser, $estRempli);
    }

    /**
     * Permet de savoir si un utilisateur à finalisé son inscription
     * @param string $email
     * @return bool true si l'utilisateur n'est pas estRempli, false sinon
     */
    public static function utilisateurEstRempli(string $email) : bool{
        global $dsn, $login, $mdp;
        $gateway = new UtilisateurGateway(new Connexion($dsn, $login, $mdp));
        return $gateway->utilisateurEstRempli($email);
    }

}