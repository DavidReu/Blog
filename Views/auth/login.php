<form action="login" method="POST" class="d-flex flex-column justify-content-center m-0">
    <?php if ($session->get('admin') != true && $session->get('user') != true) : ?>
        <input type="text" name="email" placeholder="Email">
        <input type="password" name="mdp" placeholder="Mot de passe">
        <button class="btn btn-info" type="submit" name="connexion">Connexion</button>
    <?php else : ?>
        <a href="../deconnexion" class="btn btn-info" name="deconnexion">Déconnexion</a>
    <?php endif ?>
</form>