<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

//---------- Require ----------
require_once('vendor/autoload.php');
//-----------------------------

use App\Controllers\ArticleController;

$articleController = new ArticleController();
var_dump($articleController);

if (isset($_GET['article']) && $_GET['article'] != 'new') {
    $id = $_GET['article'];
    $articleController->showArticle($id);
}
if (isset($_GET['article']) && $_GET['article'] == 'new') {
    $articleController->createForm();
} else {
    $articleController->home();
}
