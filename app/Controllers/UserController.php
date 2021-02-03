<?php

namespace App\Controllers;

class UserController
{

    public function login()
    {
        $mail = "admin@mail.com";
        $mdp = "admin";
        if ($_POST["email"] == $mail && $_POST["mdp"] == $mdp) {
            $_SESSION['admin'] = true;
        }
    }

    public function logout()
    {
        if (isset($_POST['deconnexion'])) {
            $_SESSION['admin'] = false;
        }
    }
}
