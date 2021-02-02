<?php
header("Location:../index.php");
require('PdoController.php');
require('../Models/ArticleModel.php');


//---------- Création des objets et connexion à la DB ----------
$myPDO = new MyPDO();
$pdo = $myPDO->getPDO();
$article = new ArticleModel($pdo);
//------------------------------

if (isset($_POST['poster'])) {
    $article->create($_POST['titre'], $_POST['contenu'], '/stage/blog/upload/' . $_FILES['img']['name']);

    if ((isset($_FILES["img"]))) {
        $dossier = '../upload/';
        $fichier = basename($_FILES['img']['name']);
        move_uploaded_file($_FILES["img"]["tmp_name"], $dossier . $fichier);
    }
}


exit();
