<?php


class ModelTache
{
    /**
     * Permet d'ajouter une tâche
     * @param string $email créateur de la tâche
     * @param int $idProjet id du projet à qui appartient la tâche
     * @param string $nomTache nom de la tâche
     * @param string $description description de la tâche
     * @param int $cout coût de la tâche
     * @param string $dateDebut date de début de la tâche
     * @param int $duree durée de la tâche
     * @return int
     */
    public static function ajouterTache($email, $idProjet, $nomTache, $description, $cout, $dateDebut, $duree): int
    {

        global $dsn, $login, $mdp;
        $tachegw = new TacheGateway(new Connexion($dsn, $login, $mdp));
        return $tachegw->ajouterTache($email, $idProjet, $nomTache, $description, $cout, $dateDebut, $duree);
    }

    /**
     * Permet d'associer une tache à un utilisateur
     * @param string $email utilisateur à associer à une tache
     * @param int $idtache tache à ajouter
     */
    public static function ajouterMembreTache(string $email, int $idtache): void
    {
        global $dsn, $login, $mdp;
        $tachegw = new TacheGateway(new Connexion($dsn, $login, $mdp));
        $tachegw->ajouterMembreTache($email, $idtache);
    }

    /**
     * Permet de supprimer toutes les tâches d'un projet donné
     * @param int $idProjet id du projet
     */
    public static function deleteTachesByIdProjet(int $idProjet)
    {
        global $dsn, $login, $mdp;
        $tachegw = new TacheGateway(new Connexion($dsn, $login, $mdp));
        $taches = self::getAllTachesByIdProjet($idProjet);
        $tachegw->deleteTachesByIdProjet($idProjet, $taches);
    }

    /**
     * Permet de récupérer toutes les tâches d'un projet
     * @param int $idProjet projet à récupérer
     * @return array tableau de tache
     */
    public static function getAllTachesByIdProjet(int $idProjet): array
    {
        $taches = array();
        global $dsn, $login, $mdp;
        $tachegw = new TacheGateway(new Connexion($dsn, $login, $mdp));
        $results = $tachegw->getAllTachesByIdProjet($idProjet);
        foreach ($results as $row) {
            $taches[] = new Tache($row['idTache'], $row['email'], $row['idProjet'], $row['nomTache'], $row['description'],
                $row['cout'], $row['dateDebut'], $row['duree']);
        }
        return $taches;
    }

    /**
     * Permet de récupérer le jour voulu par rapport au jour de la semaine
     * @param int $index jour de la semaine voulu
     * @return string
     * @throws Exception
     */
    public static function gestionJoursSemaine(int $index, int $numeroSemaine): string
    {
        if ($numeroSemaine == 0)
            $tmstp_today = strtotime(date('d-m-Y'));
        else {
            $tmstp_today = strtotime( "next monday" );
            if ($numeroSemaine > 1){
                $tmstp_today = $tmstp_today + strtotime("+" . $numeroSemaine-1 . "week");
            }
        }
        $date = new DateTime(date('Y-m-d', $tmstp_today));
        $jour = date('w', $tmstp_today);
        $diff = $index - $jour;
        if ($diff < 0) {
            return $date->sub(new DateInterval('P' . abs($diff) . 'D'))->format('d-m-Y');
        } else if ($diff > 0) {
            return $date->add(new DateInterval('P' . abs($diff) . 'D'))->format('d-m-Y');
        }
        return $date->format('d-m-Y');

    }


}