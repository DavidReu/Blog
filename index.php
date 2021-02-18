<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
//define("ROOT", '/');

//---------- Require ----------
require_once('vendor/autoload.php');
//-----------------------------

//---------- Use ----------
use App\Controllers\ArticleController;
use App\Controllers\CommentaireController;
use App\Controllers\UserController;
use App\Models\CommentaireModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
//--------------------------

$request = Request::createFromGlobals();
$uri = $request->getPathInfo();

//---------- SESSION ----------
$session = new Session();
$session->get('admin', false);
$session->get('user', false);
$session->get('userId', null);
if ($session->get('admin') == true || $session->get('user') == true) {
    foreach ($session->getFlashBag()->get('notice', []) as $message) {
        include('Views/auth/messagelog.php');
    }
} else {
    foreach ($session->getFlashBag()->get('erreur', []) as $message) {
        include('Views/auth/messagelog.php');
    }
}
//-----------------------------




$articleController = new ArticleController();
$userController = new UserController();


/* --------- Autre router possible -----------
$string = 'App\Controllers\ArticleController@home';
//dd(explode('@', $string));
$tab = explode('@', $string);
//dd($tab);
$controller1 = new $tab[0]();
$method1 = $tab[1];
------------------------------------------- */


$map = [
    '/login' => ['controller' => UserController::class, 'method' => 'login'],
    '/deconnexion' => ['controller' => UserController::class, 'method' => 'logout'],
    '/delete' => ['controller' => ArticleController::class, 'method' => 'delete'],
    '/' => ['controller' => ArticleController::class, 'method' => 'home'],
    '/article' => ['controller' => ArticleController::class, 'method' => 'showArticle'],
    '/article/new' => ['controller' =>  ArticleController::class, 'method' => 'createForm'],
    '/article/update' => ['controller' => ArticleController::class, 'method' => 'formUpdate'],
    '/inscription' => ['controller' => UserController::class, 'method' => 'register'],
    '/commentaire' => ['controller' => CommentaireController::class, 'method' => 'createCom'],
    '/list/users' => ['controller' => UserController::class, 'method' => 'showUsers'],
    '/list/comments' => ['controller' => CommentaireController::class, 'method' => 'showAllComments'],
    '/users' => ['controller' => UserController::class, 'method' => 'getUsers'],
    '/comments' => ['controller' => CommentaireController::class, 'method' => 'getComments'],
    '/userUpdate' => ['controller' => UserController::class, 'method' => 'updateUser'],
    '/profil' => ['controller' => UserController::class, 'method' => 'getUserProfil'],
    '/profil/modifier' => ['controller' => UserController::class, 'method' => 'updateProfil'],
    '/updateComment' => ['controller' => CommentaireController::class, 'method' => 'updateComment']
];


if (isset($map[$uri])) {
    $controller = new $map[$uri]['controller']();
    $method = $map[$uri]['method'];
    $controller->$method($request);
} else {
    new Response("Aucune page n'a été trouvé", 404);
    echo "Erreur 404 cette page n'existe pas";
}
