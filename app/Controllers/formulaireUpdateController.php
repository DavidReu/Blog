<?php
session_start();
header("Location:" . $_SESSION['uri']);
$id = $_SESSION['id'];
require('PdoController.php');
require('../Models/ArticleModel.php');

//---------- Création des objets et connexion à la DB ----------
$myPDO = new MyPDO();
$pdo = $myPDO->getPDO();
$article = new ArticleModel($pdo);
var_dump($article);
//------------------------------



if (isset($_POST['modifier'])) {
    echo 'Luffy';
    $id = $_GET['article'];
    echo $id;
    var_dump($id);
    $article->update($id, $_POST['titre'], $_POST['contenu'], '/stage/blog/upload/' . $_FILES['img']['name']);
}
exit();
