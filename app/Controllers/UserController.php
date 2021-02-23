<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\CommentaireModel;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Models\UserModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

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
        } else {
            $session = new Session();
            $session->getFlashBag()->add('erreur', 'Erreur de connexion');
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

        $logger = new Logger("create_user");
        $logger->pushHandler(new StreamHandler('/var/www/html/my_app.log', Logger::DEBUG));
        $logger->pushHandler(new FirePHPHandler());

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
            $role = $request->request->get('role');
            $userModel->register($mail, $mdp, $nom, $prenom, $role);
            $logger->info('Utilisateur bien enregistré');
        } else {
            $logger->error('Erreur lors de l\'enregistrement de l\'utilisateur');
        }
        $this->render('formRegister', ['user' => '']);
    }

    public function showUsers(Request $request)
    {
        $userModel = new UserModel();
        $users = $userModel->getUsers();
        $this->render('listUsers', ['users' => $users]);

        $logger = new Logger("delete_user");
        $logger->pushHandler(new StreamHandler('/var/www/html/my_app.log', Logger::DEBUG));
        $logger->pushHandler(new FirePHPHandler());

        if ($request->getMethod() == "DELETE") {
            $userModel = new UserModel();
            $id = $request->query->get('id');
            $delete = $userModel->deleteUser($id);
            $logger->info('Suppression réussie');
            $jsonResponse = new JsonResponse(['success' => 'Tout c\'est bien passé'], 200);
            json_encode($jsonResponse);
            $jsonResponse->send();
        } else {
            $logger->error('Echec de la suppression');
        }
    }

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
            json_encode($jsonResponse);
            $jsonResponse->send();
        }
    }

    public function updateUser(Request $request)
    {
        $userModel = new UserModel();
        $id = $request->query->get('id');
        $user = $userModel->getUser($id);
        $modifier = $request->get('modifier');

        $logger = new Logger("update_user");
        $logger->pushHandler(new StreamHandler('/var/www/html/my_app.log', Logger::DEBUG));
        $logger->pushHandler(new FirePHPHandler());

        if (isset($modifier)) {
            $nom = $request->request->get('nom');
            $prenom = $request->request->get('prenom');
            $mail = $request->request->get('mail');
            $userModel->updateUser($id, $nom, $prenom, $mail);
            $user = $userModel->getUser($id);
            $logger->info('Modification réussie');
        } else {
            $logger->error('Eche de la modification');
        }
        $this->render('userUpdate', ['user' => $user]);
    }

    public function getUserProfil()
    {
        $session = new Session();
        $userId = $session->get('userId');
        $userModel = new UserModel();
        $profil = $userModel->getUser($userId);
        $commentModel = new CommentaireModel();
        $comments = $commentModel->showCommentsByUser($userId);
        $this->render('userProfil', ['profil' => $profil, 'comments' => $comments]);
    }

    public function updateProfil(Request $request)
    {
        $userModel = new UserModel();
        $session = new Session();
        $id = $session->get('userId');
        $user = $userModel->getUser($id);
        $modifier = $request->get('modifier');

        $logger = new Logger("update_profil");
        $logger->pushHandler(new StreamHandler('/var/www/html/my_app.log', Logger::DEBUG));
        $logger->pushHandler(new FirePHPHandler());

        if (isset($modifier)) {
            $nom = $request->request->get('nom');
            $prenom = $request->request->get('prenom');
            $mail = $request->request->get('mail');
            $mdp = $request->request->get('pwd');
            $userModel->updateUser($id, $nom, $prenom, $mail, $mdp);
            $user = $userModel->getUser($id);
            $logger->info('Profil bien modifié');
        } else {
            $logger->error('Echec de la modification');
        }
        $this->render('updateProfil', ['user' => $user]);
    }

    public function registerEditor()
    {
    }
}
