<?php


class Utilisateur
{
    private $email;
    private $nom;
    private $prenom;
    private $estRempli;
    private $role;

    /**
     * Utilisateur constructor.
     * @param string $email email de l'utilisateur
     * @param string $nom nom de l'utilisateur
     * @param string $prenom prénom de l'utilisateur
     * @param string $estRempli utilisateur rempli ou non
     */
    public function __construct(string $email, string $nom, string $prenom, string  $estRempli){

            $this->setEmail($email);
            $this->setNom($nom);
            $this->setPrenom($prenom);
            $this->setEstRempli($estRempli);
            $this->setEstRempli($estRempli);
    }

        /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role): void
    {
        $this->role = $role;
    }



    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getEstRempli()
    {
        return $this->estRempli;
    }

    /**
     * @param mixed $estRempli
     */
    public function setEstRempli($estRempli): void
    {
        $this->estRempli = $estRempli;
    }
}