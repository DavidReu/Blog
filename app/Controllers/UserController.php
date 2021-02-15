<?php

namespace App\Controllers;

use App\Controllers\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Models\UserModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $mail = $request->request->get('email');
        $mdp = $request->request->get('mdp');
        $mail = $this->valid($mail);
        $mdp = $this->valid($mdp);
        $userModel = new UserModel();
        $user = $userModel->log($mail);
        $userId = $user->id;
        var_dump($mail);
        var_dump($mdp);

        if ($mail == $user->mail && password_verify($mdp, $user->mdp) == true) {
            $session = new Session();
            if ($user->is_admin == "1") {
                $session->set('admin', 'true');
            } else {
                $session->set('user', 'true');
            }
            $session->set('userId', $userId);
            $session->getFlashBag()->add('notice', 'Vous êtes connecté');
            (new RedirectResponse("/"))->send();
        }
    }

    public function logout()
    {
        $session = new Session();
        $session->set('admin', 'false');
        $session->set('user', 'false');
        $session->clear();
        (new RedirectResponse("index.php"))->send();
    }

    public function register(Request $request)
    {
        $userModel = new UserModel();
        $regist = $request->request->get('regist');

        if (isset($regist)) {
            $mail = $request->request->get('mail');
            $mdp = $request->request->get('mdp');
            $nom = $request->request->get('nom');
            $prenom = $request->request->get('prenom');
            $mail = $this->valid($mail);
            $mdp = $this->valid($mdp);
            $nom = $this->valid($nom);
            $prenom = $this->valid($prenom);
            $mdp = password_hash($mdp, PASSWORD_BCRYPT);
            $userModel->register($mail, $mdp, $nom, $prenom);
        }
        $this->render('formRegister', ['user' => '']);
    }

    public function showUsers()
    {
        $userModel = new UserModel();
        $users = $userModel->getUsers();
        $this->render('listUsers', ['users' => $users]);
    }

    /* public function getUsers(Request $request)
    {
        dd($request);
        $userModel = new UserModel();
        $users = $userModel->getUsers();
        $jsonResponse = new JsonResponse($users);
        $jsonResponse->send();
    } */

    public function getUsers(Request $request)
    {
        if ($request->getMethod() == "GET") {
            $userModel = new UserModel();
            $users = $userModel->getUsers();
            $jsonResponse = new JsonResponse($users);
            $jsonResponse->send();
        }
        if ($request->getMethod() == "DELETE") {
            $userModel = new UserModel();
            $id = $request->query->get('id');
            $delete = $userModel->deleteUser($id);
            $jsonResponse = new JsonResponse(['success' => 'Tout c\'est bien passé'], 200);
            $jsonResponse->send();
        }
    }
}
