<?php


class ProjetGateWay
{    private $con;

    function __construct(Connexion $con)
    {
        $this->con = $con;
    }
    /**
     * Permet de récupérer un projet en fonction d'un idProjet
     * @param int $idProjet id du projet
     * @return Projet array
     */
    public function getProjetbyID(int $idProjet) : array{
        $query = 'SELECT * FROM projet where idProjet=:idProjet';
        $this->con->executeQuery($query, array(':idProjet' => array($idProjet, PDO::PARAM_INT)));
        return $this->con->getResult();
    }

    /**
     * Permet d'ajouter un projet dans la base de données
     * @param $nomprojet // nom du projet
     * @param $mail // login user
     */
    public function ajouterProjet(string $nomprojet, string $mail, string $description, int $budget, string $dateDebut) :int  {

        $query = "insert into projet values(NULL, :nomprojet, :description, :budget, :dateDebut, false, :mail)"; //INSERT ID AUTO INCREMENT
        $this->con->executeQuery($query, array( ':nomprojet' =>  array($nomprojet, PDO::PARAM_STR), ':description' => array($description, PDO::PARAM_STR), ':budget' => array($budget, PDO::PARAM_INT),
            ':mail' =>  array($mail, PDO::PARAM_STR), ':dateDebut' => array($dateDebut, PDO::PARAM_STR)));

        $idProjet = $this->con->lastInsertId();
        $query = "insert into estMembre values(:idProjet, :mail, 'chefProjet')";

        $this->con->executeQuery($query, array(':idProjet' => array($idProjet, PDO::PARAM_INT),
            ':mail' =>  array($mail, PDO::PARAM_STR)));
        return $idProjet;
    }

    /**
     * Permet d'ajouter un membre à un projet
     * @param string $mail
     * @param int $idProjet id
     */
    public function ajouterMembre(string $mail, int $idProjet)
    {
        $query = "insert into estMembre values(:idProjet, :mail, 'utilisateur')";
        $this->con->executeQuery($query, array(':idProjet' => array($idProjet, PDO::PARAM_INT),
            ':mail' =>  array($mail, PDO::PARAM_STR)));
    }

    /**
     * Permet de récupérer les projets propres à un utilisateur
     * @param string $email mail de l'utilisateur
     * @param string $tri
     * @return mixed
     */
    public function getAllProjetsByMail(string $email, string $tri)
    {
        switch ($tri) {
            case "A-Z":
                setcookie("tri", $tri);
                $query = 'SELECT * FROM projet p, estmembre e WHERE  e.email=:email AND e.idProjet = p.idProjet ORDER BY p.nomProjet';
                break;
            case "Z-A":
                setcookie("tri", $tri);
                $query = 'SELECT * FROM projet p, estmembre e WHERE  e.email=:email AND e.idProjet = p.idProjet ORDER BY p.nomProjet DESC';
                break;
            case "Date":
            default:
                setcookie("tri", "");
                $query = 'SELECT * FROM projet p, estmembre e WHERE  e.email=:email AND e.idProjet = p.idProjet ORDER BY e.idProjet';
                break;
        }
        $this->con->executeQuery($query, array(':email' => array($email, PDO::PARAM_STR)));
        return $this->con->getResults();
    }

    /**
     * Permet de supprimer un projet et ses tâches associées
     * @param int $idListeTaches id du projet à supprimer
     */
    public function deleteProjet(int $idProjet)
    {
        $query = 'DELETE FROM estmembre where idProjet=:idProjet';
        $this->con->executeQuery($query, array(':idProjet' => array($idProjet, PDO::PARAM_INT)));

        $query = 'DELETE FROM projet where idProjet=:idProjet';
        $this->con->executeQuery($query, array(':idProjet' => array($idProjet, PDO::PARAM_INT)));
    }

    /**
     * Permet de récupérer le nombre de projets
     * @return mixed
     */
    public function nbProjet(): array
    {
        $query = 'SELECT count(*) FROM projet';
        $this->con->executeQuery($query, array());
        return $this->con->getResults();
    }

    /**
     * Permet de mettre un projet sur l'état terminé
     * @param int $idProjet id du projet à modifier
     */
    public function terminerProjet(int $idProjet)
    {
        $query = 'UPDATE projet SET estTermine = true WHERE idProjet = :idProjet';
        $this->con->executeQuery($query, array(':idProjet' => array($idProjet, PDO::PARAM_INT)));
    }
}
