<?php


class TacheGateway
{
    private $con;

    public function __construct(Connexion $con)
    {
        $this->con = $con;

    }

    /**
     * @param $email
     * @param $idProjet
     * @param $nomTache
     * @param $description
     * @param $cout
     * @param $dateDebut
     * @param $duree
     * @return mixed
     */

    public function ajouterTache(string $email,string $idProjet, $nomTache, $description, $cout, $dateDebut, $duree) : int
    {
        $query = 'insert into tache values(NULL,:email,:idProjet,:nomtache,:description, :cout, :dateDebut, :duree)';
        $this->con->executeQuery($query, array(':email' => array($email, PDO::PARAM_STR),
            ':idProjet' => array($idProjet, PDO::PARAM_INT),
            ':nomtache' => array($nomTache, PDO::PARAM_STR),
            ':description' => array($description, PDO::PARAM_STR),
            ':cout' => array($cout, PDO::PARAM_INT),
            ':dateDebut' => array($dateDebut, PDO::PARAM_STR),
            ':duree' => array($duree, PDO::PARAM_INT)));
        return $this->con->lastInsertId();

    }


    /**
     * Permet de récupérer toutes les tâches d'un projet
     * @param int $idProjet projet à récupérer
     * @return array tableau de tache
     */
    public function getAllTachesByIdProjet(int $idProjet): array
    {
        $query = 'select * from tache where idProjet=:idProjet'; //à rajouter l'affichage des tâches en fonction de l'utilisateur AUSSI.
        $this->con->executeQuery($query, array(':idProjet' => array($idProjet, PDO::PARAM_INT)));
        return $this->con->getResults();
    }

    /**
     * Permet d'associer une tache à un utilisateur
     * @param string $email utilisateur à associer à une tache
     * @param int $idtache tache à ajouter
     */
    public function ajouterMembreTache(string $email, int $idtache): void
    {
        $query = 'insert into travaille values(:email,:idTache)';
        $this->con->executeQuery($query, array(':email' => array($email, PDO::PARAM_STR),
            ':idTache' => array($idtache, PDO::PARAM_INT)));
    }

    /**
     * Permet de supprimer toutes les tâches d'un projet donné, dans la table travaille puis dans la table tache
     * @param int $idProjet id du projet
     * @param array $taches taches du projet
     */
    public function deleteTachesByIdProjet(int $idProjet, array $taches) : void
    {
        foreach ($taches as $tache) {
            $query = 'DELETE FROM travaille WHERE idTache = :idTache';
            $this->con->executeQuery($query, array(':idTache' => array($tache->getIdTache(), PDO::PARAM_INT)));
        }
        $query = 'DELETE FROM tache WHERE idProjet = :idProjet';
        $this->con->executeQuery($query, array(':idProjet' => array($idProjet, PDO::PARAM_INT)));
    }


}