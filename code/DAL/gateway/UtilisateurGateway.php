<?php


class UtilisateurGateway
{
    private $con;

    public function __construct($c)
    {
        $this->con = $c;
    }

    /**
     * Permet de savoir si l'utilisateur est inscrit dans la base de donnée quand il veut se connecter
     * @param string $email email à vérifier
     * @param string $mdp mot de passe à vérifier
     * @return bool true si inscrit, false sinon
     */
    public function rechercherUtilisateur(string $email, string $mdp): bool
    {
        $query = 'SELECT * FROM utilisateur WHERE email=:email';
        $this->con->executeQuery($query, array(':email' => array($email, PDO::PARAM_STR)));
        $result = $this->con->getResult();
        if (isset($result['email'])) {
            return password_verify($mdp, $result['motdepasse']);
        } else return false;
    }

    /**
     * Permet de savoir si un utilisateur existe avec son mail
     * @param string $email mail à vérifier
     * @return mixed
     */
    public function rechercherUtilisateurByMail(string $email)
    {
        $query = 'SELECT * FROM utilisateur WHERE email=:email';
        $this->con->executeQuery($query, array(':email' => array($email, PDO::PARAM_STR)));
        $result = $this->con->getResult();
        if ($result == 0) {
            return null;
        }
        return $result;
    }

    /**
     * @param string $email email du membre à rechercher
     * @param int $idProjet idProjet à vérifier si l'utilisateur en est membre
     * @return bool membre existe ou non
     */
    public function rechercheMembreProjet(string $email, int $idProjet): bool
    {
        $query = 'SELECT * FROM estmembre WHERE email=:email and idProjet =:idprojet';
        $this->con->executeQuery($query, array(':email' => array($email, PDO::PARAM_STR),
            ':idprojet' => array($idProjet, PDO::PARAM_INT)));
        $result = $this->con->getResult();
        if ($result == 0) {
            return false;
        }
        return true;
    }

    /**
     * Permet d'inscrire un nouvel utilisateur
     * @param string $email email de l'utilisateur
     * @param string $nom nom de l'utilisateur
     * @param string $prenom prénom de l'utilisateur
     * @param string $mdp mot de passe de l'utilisateur
     * @param bool $estRempli true si inscription complète, false sinon
     */
    public function ajouterUtilisateur(string $email, string $nom, string $prenom, string $mdp, bool $estRempli): void
    {
        $query = 'INSERT INTO utilisateur VALUES(:email, :nom, :prenom, :mdp, :estRempli)';
        $this->con->executeQuery($query, array(':email' => array($email, PDO::PARAM_STR),
            ':nom' => array($nom, PDO::PARAM_STR),
            ':prenom' => array($prenom, PDO::PARAM_STR),
            ':mdp' => array(password_hash($mdp, PASSWORD_DEFAULT), PDO::PARAM_STR),
            ':estRempli' => array($estRempli, PDO::PARAM_BOOL)));
    }

    /**
     * Permet de vérifier si un utilisateur est chef de projet sur un projet donné
     * @param int $idProjet id du projet à vérifier
     * @param string $email email de l'utilisateur à vérifier
     */
    public function isChefProjet(int $idProjet, string $email): bool
    {
        $query = 'SELECT count(*) FROM estmembre WHERE email=:email and idProjet =:idprojet and role = "chefProjet"';
        $this->con->executeQuery($query, array(':email' => array($email, PDO::PARAM_STR),
            ':idprojet' => array($idProjet, PDO::PARAM_INT)));
        $result = $this->con->getResult();
        if ($result == 0) {
            return false;
        }
        return true;
    }

    /**
     * Permet de récupérer la liste des utilisateurs associés à une tâche
     * @param int $idTache id de la tache à rechercher
     * @return array |null
     */
    public function getAllUtilisateursByIdTache(int $idTache): array
    {
        $query = 'SELECT u.email, u.nom, u.prenom, u.estRempli FROM travaille t, utilisateur u WHERE t.idTache =:idTache and t.emailMembre = u.email';
        $this->con->executeQuery($query, array(':idTache' => array($idTache, PDO::PARAM_INT)));
        return $this->con->getResults();
    }

    /***
     * Permet de récupérer la liste des membres d'un projet.
     * @param int $idprojet id du projet.
     * @return array
     */
    public function getAllMembresProjet(int $idprojet) : array {

        $query = 'SELECT * FROM estmembre, utilisateur WHERE estmembre.email = utilisateur.email and  estmembre.idProjet =:idprojet';
        $this->con->executeQuery($query, array(':idprojet' => array($idprojet, PDO::PARAM_INT)));
        return $result = $this->con->getResults();

    }
    /**
     * Permet de modifier un utilisateur
     * @param string $email
     * @param string $nom
     * @param string $prenom
     * @param string $mdp
     * @param bool $estRempli
     */
    public function modifierUtilisateur(string $email, string $nom, string $prenom, string $mdp, bool $estRempli){
        $query = 'UPDATE utilisateur SET nom=:nom, prenom=:prenom, motdepasse=:mdp, estRempli=:estRempli WHERE email=:email';
        $this->con->executeQuery($query, array(':email' => array($email, PDO::PARAM_STR),
            ':nom' => array($nom, PDO::PARAM_STR),
            ':prenom' => array($prenom, PDO::PARAM_STR),
            ':mdp' => array(password_hash($mdp, PASSWORD_DEFAULT), PDO::PARAM_STR),
            ':estRempli' => array($estRempli, PDO::PARAM_BOOL)));
    }
    /**
     * Permet de savoir si un utilisateur à finalisé son inscription
     * @param string $email
     * @return bool
     */
    public function utilisateurEstRempli(string $email){
        $query = "SELECT count(*) FROM utilisateur WHERE email=:email AND estRempli=false";
        $this->con->executeQuery($query, array(':email' => array($email, PDO::PARAM_STR)));
        $result = $this->con->getResult();
        if($result == 0){
            return false;
        }
        return true;
    }
}