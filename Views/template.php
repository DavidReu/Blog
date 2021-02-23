<?php

use Symfony\Component\HttpFoundation\Session\Session;

$session = new Session();
?>
<!DOCTYPE html>
<html>
<!-- Template utilisé pour toutes les pages -->

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/style.css">
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
                            <a href="index.php/inscription" class="btn btn-large btn-info h-25">S'inscrire</a>
                        <?php endif ?>
                        <?php include('auth/login.php') ?>

                    </div>
                </div>

            </div>
        </nav>
        <div class="mt-5">
            <h1 class="text-center">Bonjour</h1>
            </h1>
        </div>
    </header>

    <?php
    //echo $content;
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../public/js/app.js"></script>
</body>


</html>