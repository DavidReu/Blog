<?php if ($session->get('admin') == true) : ?>
    <a class="nav-link" href="/showForm">Créer un Article</a>
    <a class="nav-link" href="/list/users">Liste utilisateurs</a>
    <a class="nav-link" href="/list/comments">Liste commentaires</a>
    <a class="nav-link" href="/registerEditor">Inscrire un Rédacteur</a>
<?php elseif ($session->get('user') == true) : ?>
    <a class="nav-link" href="/profil">Mon profil</a>
<?php else : ?>

<?php endif ?>