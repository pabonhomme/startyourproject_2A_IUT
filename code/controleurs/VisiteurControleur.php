<?php

use PHPMailer\PHPMailer\PHPMailer;

class VisiteurControleur
{
    function __construct()
    {
        global $rep, $vues;

        try {
            if (isset($_REQUEST["action"])) {
                $action = $_REQUEST["action"];
            } else {
                $action = NULL;
            }
            switch ($action) {
                case NULL:
                    $this->afficherAccueil();
                    break;
                case "AfficherInscription" :
                    $this->afficherInscription();
                    break;
                case "AfficherConnexion":
                    $this->afficherConnexion();
                    break;
                case "SeConnecter":
                    $this->seConnecter();
                    break;
                case"Inscription":
                    $this->inscription();
            }
        } catch (PDOException $e) {
            $erreur = $e->getMessage();
            require($rep . $vues['pageErreur']);
        }
    }

    /**
     * Permet d'afficher la page d'accueil
     */
    private function afficherAccueil(): void
    {
        global $rep, $vues, $images, $bootstrapCSS, $bootstrapJS, $bootstrapJquery, $bootstrapJava;
        $isUtilisateur = ModelUtilisateur::isUtilisateur();
        require($rep . $vues['pageAccueil']);
    }

    /**
     * Permet d'afficher la page d'inscription
     */
    private function afficherInscription(): void
    {
        global $rep, $vues;
        require($rep . $vues['inscription']);
    }

    /**
     * Permet d'afficher la page de connexion
     */
    private function afficherConnexion(): void
    {
        global $rep, $vues;
        $isUtilisateur = ModelUtilisateur::isUtilisateur();
        require($rep . $vues['pageConnexion']);
    }

    /**
     * Permet de se connecter
     */
    private function seConnecter(): void
    {
        global $rep, $vues;
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
        $data = array();
        $Vueerreur = Validation::ValidationConnexion($email, $mdp); // vérification que les données sont valides
        if (empty($Vueerreur)) { // si valides
            if (ModelUtilisateur::connexion($email, $mdp)) { // si l'utilisateur est dans la base de données
                $data[] = "Connexion réussie !"; // valeur affichée dans la vue
                header('Refresh:1;url=index.php?action=AfficherPageMesProjets');
            } else {
                $data[] = "Problème de connexion ! Le pseudo ou mot de passe est incorrect !"; // erreur de type pseudo ou mdp incorrect valeur affichée dans la vue
            }
        } else {
            require($rep . $vues['pageErreur']); // erreur de type injection affichée dans la vue d'erreur
            header('Refresh:2;url=index.php?action=AfficherConnexion');
        }
        sleep(1); // attente pour afficher bandeau statut connexion
        require($rep . $vues['pageConnexion']);
    }

    /**
     * Permet de s'inscrire
     * @throws \PHPMailer\PHPMailer\Exception
     */
    private function inscription(): void
    {
        global $rep, $vues, $body;

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";

        $email = $_REQUEST['email'];
        $prenom = $_REQUEST['prenom'];
        $nom = $_REQUEST['nom'];
        $mdpVerify = $_REQUEST['mdpVerify'];
        $mdp = $_REQUEST['mdp'];

        $mail = new PHPMailer();

        //parametrage du SMTP
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "startyourproject2020@gmail.com";
        $mail->Password = 'mdpsimple';
        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";

        //paeametrage de l'email
        $mail->isHTML(true);
        $mail->setFrom($email, $nom);
        $mail->addAddress($email);
        $mail->Subject = ("$email ,Validation inscription Start Your Project");
        $mail->Body = $body;

        $mail->send();

        if (strcmp($mdp, $mdpVerify) == 0) {
            if(ModelUtilisateur::utilisateurEstRempli($email)){
                ModelUtilisateur::modifierUtilisateur($email, $nom, $prenom, $mdp, true);
            }
            ModelUtilisateur::inscription($email, $nom, $prenom, $mdp, true);
            require($rep . $vues['pageConnexion']);
        } else {
            $erreur = "problème de'inscription";
            require($rep . $vues['pageErreur']);
        }


    }
}