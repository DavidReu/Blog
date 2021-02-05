<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;

class UserController
{
    public function login(Request $request)
    {

        $mail = $request->request->get('email');
        $mdp = $request->request->get('mdp');
        if ($mail == "admin@mail.com" && $mdp == "admin") {
            $session = new Session();
            $session->set('admin', 'true');
            // set flash messages
            $session->getFlashBag()->add('notice', 'Vous êtes connecté');
            //return $_SESSION['admin'];
            (new RedirectResponse("/stage/blog/index.php"))->send();
        }
    }

    public function logout(Request $request)
    {
        $session = new Session();
        $session->get('admin', 'false');
        $session->clear();
        (new RedirectResponse("/stage/blog/index.php"))->send();
    }
}
