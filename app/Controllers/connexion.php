<?php
session_start();
$mail = "admin@mail.com";
$mdp = "admin";
if ($_POST["email"] == $mail && $_POST["mdp"] == $mdp) {
    //var_dump($_SESSION['admin']);
    $_SESSION['admin'] = true;
    var_dump($_SESSION['admin']);
} else {
    echo "Connexion échouée";
}

if (isset($_POST['deconnexion'])) {
    $_SESSION['admin'] = false;
}
header('Location:/stage/blog/index.php');

exit();
