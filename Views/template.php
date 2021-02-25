<?php

use Symfony\Component\HttpFoundation\Session\Session;

$session = new Session();
$uri = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="fr">
<!-- Template utilisé pour toutes les pages -->

<head>
    <title>Le blog chill</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/style.css">
    <!-- AniCollection.css library -->
    <link rel="stylesheet" href="http://anijs.github.io/lib/anicollection/anicollection.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
</head>

<body id="body">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" aria-current="page" href="/">Accueil</a>
                        <?php include('Views/auth/nav.php') ?>
                    </div>
                </div>
                <div class="container w-50">
                    <div class="d-flex justify-content-around align-items-center py-2">
                        <?php if ($session->get('admin') != true && $session->get('user') != true && $session->get('editor') != true) : ?>
                            <a href="inscription" class="btn btn-large btn-info rounded-pill h-25">S'inscrire</a>
                            <?php if ($uri != "/connexion") : ?>
                                <a href="/connexion" class="btn btn-large btn-info h-25 rounded-pill">Se connecter</a>
                            <?php endif ?>
                        <?php else : ?>
                            <a href="/deconnexion" class="btn btn-info rounded-pill" name="deconnexion">Déconnexion</a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>