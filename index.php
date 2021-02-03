<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
define("ROOT", '/Applications/MAMP/htdocs/stage/blog/');
session_start();

//---------- Require ----------
require_once('vendor/autoload.php');
//-----------------------------

use App\Controllers\ArticleController;
use App\Controllers\UserController;

$articleController = new ArticleController();
$user = new UserController();


if (isset($_POST['connexion'])) {
    $mail = $_POST['email'];
    $mdp = $_POST['mdp'];
    $user->login($mail, $mdp);
}
if (isset($_POST['deconnexion'])) {
    $user->logout();
}
if (isset($_GET['article']) && $_GET['article'] != 'new') {
    $id = $_GET['article'];
    $articleController->showArticle($id);
}
if (isset($_GET['article']) && $_GET['article'] == 'new') {
    $articleController->createForm();
}
if ($_SERVER['REQUEST_URI'] == '/stage/blog/index.php') {
    $articleController->home();
}
if (isset($_GET['update'])) {
    $id = $_GET['update'];
    $articleController->formUpdate($id);
}
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $articleController->delete($id);
}
