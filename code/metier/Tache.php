<?php

use Cassandra\Date;

class Tache
{
    private $idTache;
    private $createurTache;
    private $projet;
    private $nomTache;
    private $description;
    private $cout;
    private $dateDeb;
    private $duree;
    private $listeMembres;

    public function __construct(int $idTache, string $createurTache, int $idprojet, string $nomTache, string $description, float $cout, $dateDeb, int $duree)
    {
        $this->idTache = $idTache;
        $this->createurTache = $createurTache;
        $this->projet = $idprojet;
        $this->nomTache = $nomTache;
        $this->description = $description;
        $this->cout = $cout;
        $this->dateDeb = new DateTime($dateDeb);
        $this->duree = $duree;
    }

    /**
     * permet de gérer l'affichage des taches
     * @param int $numSemaine semaine selectionné => nombre de semaine suivant la semaine en cours soit 1 correspond à la semaine prochaine
     * @return string retourne une string composé de 2 classes CSS qui appeleront des styles différent pour un affichage correspondant
     * @throws Exception
     */
    public function settingAffichage(int $numSemaine): string
    {
        setlocale(LC_TIME, "fr_FR");
        $tmstp_dateDeb = $this->dateDeb->getTimestamp();
        $tmstp_today = strtotime(\date('Y-m-d H:i:s'));
        if ($numSemaine > 0){
            $tmstp_today = strtotime( "next monday" );
            if ($numSemaine > 1){
                $tmstp_today = $tmstp_today + strtotime("+" . $numSemaine-1 . "week");
            }
        }
        $dateFin = clone $this->dateDeb;
        $dateFin = $dateFin->add($this->getDureeToDateInterval())->format('Y-m-d H:i:s');
        $tmstp_deb_Duree = strtotime($dateFin);
        $dureeRest = $this->getDureeRest($tmstp_deb_Duree, $tmstp_today);
        $tab_jours = array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
        $jourDeb = $tab_jours[date('w', $tmstp_dateDeb)];
        $jour = $tab_jours[$this->dateDeb->format('w')];
        if ($tmstp_dateDeb < $tmstp_today) {
            if ($tmstp_deb_Duree > $tmstp_today) {
                if ($jourDeb == 'Samedi' || $jourDeb == 'Dimanche')
                    if ($this->isSameWeek($this->dateDeb, new DateTime(date('Y-m-d', $tmstp_today))))
                        return 0;
                if ($dureeRest > 5) {
                    if (!$this->isSameWeek($this->dateDeb, new DateTime(date('Y-m-d', $tmstp_today)))) {
                        return "Lundi" . " " . $this->numberconvertToString(5);
                    }
                    return $jour . " " . $this->numberconvertToString(5); // gerer la durée restante différente de l'affichage d'une tache crée dans le passée (semaine en cours)
                }
                return $jour . " " . $this->numberconvertToString($dureeRest);
            }
        }
        if ($this->isSameWeek($this->dateDeb, new DateTime(date('Y-m-d', $tmstp_today)))) {
            if ($jourDeb == 'Samedi' || $jourDeb == 'Dimanche')
                return 0;
            return $jourDeb . " " . $this->numberconvertToString($this->limitLongueur($jourDeb, $dureeRest));
        }

        return 0;
    }

    /**
     * permet de récupérer la durée de la tache en type DateInterval
     * @return DateInterval
     */
    public function getDureeToDateInterval(): DateInterval
    {
        try {
            return new DateInterval('P' . $this->duree . 'D');
        } catch (Exception $e) {
        }
    }

    /**
     * permet de calculer la durée restante de la tâche
     * @param $tmstp_deb_Duree
     * @param $tmstp_today
     * @return int
     * @throws Exception
     */
    public function getDureeRest($tmstp_deb_Duree, $tmstp_today): int
    {
        $nbjWeekEnd = $this->removeWeekEnd($tmstp_deb_Duree);
        $dateFin = clone $this->dateDeb;
        $dateFin = $dateFin->add($this->getDureeToDateInterval())->format('Y-m-d H:i:s');
        if($this->isSameWeek($this->dateDeb, new DateTime(date('Y-m-d', $tmstp_today)))){
            $dureeRest = date_diff((new DateTime($dateFin)), $this->dateDeb, false);
        }
        else $dureeRest = date_diff((new DateTime($dateFin)), new DateTime(date('Y-m-d', $tmstp_today)), false);
        return $dureeRest->days + $nbjWeekEnd;
    }

    /**
     * permet de calculer et de retourner le nombre samedi ou dimanche durant la duree d'une tache
     * @param $tmstp_deb_Duree
     * @return int
     * @throws Exception
     */
    public function removeWeekEnd($tmstp_deb_Duree): int
    {
        $nbJweekEnd = 0;
        $datedeb = clone $this->dateDeb;
        $tmstp_dateDeb = strtotime($datedeb->format('Y-m-d H:i:s'));
        while ($tmstp_dateDeb < $tmstp_deb_Duree) {
            $jour = date('w', $tmstp_dateDeb);
            if ($jour == 0 || $jour == 6)
                $nbJweekEnd++;
            $datedeb = $datedeb->add(new DateInterval('P' . 1 . 'D'));
            $tmstp_dateDeb = strtotime($datedeb->format('Y-m-d H:i:s'));
        }

        return $nbJweekEnd;
    }

    /**
     * permet de verifier si 2 dates sont dans la même semaine
     * @param $date1
     * @param $date2
     * @return bool retourne true si c'est dans la même semaine et false si ellesne sont pas dans la même semaine
     */
    public function isSameWeek($date1, $date2): bool
    {
        if ($date1->format("W") == $date2->format("W"))
            return true;
        return false;
    }

    /**
     * permet de convertir un nombre en string
     * @param $index
     * @return string
     */
    public function numberconvertToString($index): string
    {
        switch ($index) {
            case 1:
                return "un";
            case 2:
                return "deux";
            case 3 :
                return "trois";
            case 4 :
                return "quatre";
            case 5 :
                return "cinq";
            default :
                return '0';

        }

    }

    /**
     * permet de retourner une duree pas trop grande par rapport à la semaine pour que la tache s'affiche bien
     * @param $jour
     * @param $duree
     * @return int
     */
    public function limitLongueur($jour, $duree): int
    {
        if ($jour == "Lundi" & $duree > 5)
            return 5;
        if ($jour == "Mardi" && $duree > 4)
            return 4;
        if ($jour == "Mercredi" && $duree > 3)
            return 3;
        if ($jour == "Jeudi" && $duree > 2)
            return 2;
        if ($jour == "Vendredi" && $duree > 1)
            return 1;
        return $duree;
    }

    /**
     * permet de retourner un string aléatoire compris dans le tableau $tabColor
     * @return string
     */
    public function randomColor(): string
    {
        $tabColor = array("success", "primary", "danger", "info");
        return "bg-" . $tabColor[rand(0, 3)];
    }

    /**
     * @return int
     */
    public function getIdTache(): int
    {
        return $this->idTache;
    }

    /**
     * @return string
     */
    public function getCreateurTache(): string
    {
        return $this->createurTache;
    }

    /**
     * @return int
     */
    public function getProjet(): int
    {
        return $this->projet;
    }

    /**
     * @return string
     */
    public function getNomTache(): string
    {
        return $this->nomTache;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return float
     */
    public function getCout(): float
    {
        return $this->cout;
    }

    /**
     * @return string
     */
    public function getDateDebToString(): string
    {
        return $this->dateDeb->format("Y-m-d");
    }

    /**
     * @return int
     */
    public function getDuree(): int
    {
        return $this->duree;
    }

    public function getDateDeb(): DateTime
    {
        return $this->dateDeb;
    }

    /**
     * @return mixed
     */
    public function getListeMembres(): string
    {
        return $this->listeMembres;
    }

    /**
     * @param mixed $listeMembres
     */
    public function setListeMembres(string $listeMembres): void
    {
        $this->listeMembres = $listeMembres;
    }
}

