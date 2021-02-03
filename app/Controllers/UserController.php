<?php

namespace App\Controllers;

class UserController
{
    /*  private $id;
    private $mail;
    private $mdp;
    private $nom;
    private $prenom; */

    public function login()
    {
        $mail = "admin@mail.com";
        $mdp = "admin";
        $admin = false;
        if ($_POST["email"] == $mail && $_POST["mdp"] == $mdp) {
            //var_dump($_SESSION['admin']);
            $admin = true;
            var_dump($_SESSION['admin']);
        } else {
            echo "Connexion échouée";
        }

        if (isset($_POST['deconnexion'])) {
            $_SESSION['admin'] = false;
        }
    }
}
