<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
define("ROOT", '/Applications/MAMP/htdocs/stage/blog/');

//---------- Require ----------
require_once('vendor/autoload.php');
//-----------------------------

//---------- Use ----------
use App\Controllers\ArticleController;
use App\Controllers\UserController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
//--------------------------

$request = Request::createFromGlobals();
$uri = $request->getPathInfo();

//---------- SESSION ----------
$session = new Session();
//$session->start();
$session->get('admin', false);
// retrieve messages
if ($session->get('admin') == true) {
    foreach ($session->getFlashBag()->get('notice', []) as $message) {
        echo '<div id="successMessage" class="alert alert-success text-center">' . $message . '</div>';
    }
}
//-----------------------------

//var_dump($uri);
//var_dump($request->get('deconnexion'));


$articleController = new ArticleController();
$userController = new UserController();


/* $connexion = $request->request->get('connexion');
$deconnexion = $request->request->get('deconnexion'); */
//$delete = $request->request->get('delete');
//$id = $request->query->get('id');
/* if (isset($connexion)) {
    $mail = $request->request->get('email');
    $mdp = $request->request->get('mdp');
    $user->login($mail, $mdp);
} */

// connexion en tant qu'admin
if ($uri == "/login") {
    $userController->login($request);
}
//déconnexion et retour sur la page d'accueil
if ($uri == "/deconnexion") {
    $userController->logout($request);
}
//suppression d'un article
if ($uri == "/delete") {
    $articleController->delete($request);
}

//affichage de la liste des articles quand on est sur la page d'accueil
if ($uri == '/') {
    $articleController->home();
}
//affichage d'un seul article après avoir cliqué sur le bouton lire article
if ($uri == "/article") {
    $articleController->showArticle($request);
}
//page de création d'un article par un admin
if ($uri == '/article/new') {
    $articleController->createForm($request);
}
//page de modification d'un article toujours par un admin
if ($uri == "/article/update") {
    $articleController->formUpdate($request);
}
