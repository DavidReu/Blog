<?php
class User
{
    private $id;
    private $mail;
    private $mdp;
    private $nom;
    private $prenom;

    public function __construct($uid, $umail, $umdp, $unom, $uprenom)
    {
        $this->setId($uid);
        $this->setMail($umail);
        $this->setMdp($umdp);
        $this->setNom($unom);
        $this->setPrenom($uprenom);
    }

    public function setId($uid)
    {
        $this->id = $uid;
    }

    public function setMail($umail)
    {
        $this->mail = $umail;
    }

    public function setMdp($umdp)
    {
        $this->mdp = $umdp;
    }

    public function setNom($unom)
    {
        $this->nom = $unom;
    }

    public function setPrenom($uprenom)
    {
        $this->prenom = $uprenom;
    }

    public function afficherId()
    {
        echo $this->id;
    }

    public function afficherMail()
    {
        echo $this->mail;
    }

    public function afficherMdp()
    {
        echo $this->mdp;
    }

    public function afficherNom()
    {
        echo $this->nom;
    }

    public function afficherPrenom()
    {
        echo $this->prenom;
    }
}


$utilisateur1 = new User('1', 'user@mail.com', 'test', 'Doe', 'John');
