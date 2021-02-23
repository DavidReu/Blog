<?php

use Symfony\Component\HttpFoundation\Session\Session;

$session = new Session();
?>
<div class="container my-2">
    <div class="row">
        <h4>Mon profil</h4>
    </div>
    <div class="row">
        <section class="w-50">
            <?php ?>
            <div class="d-flex justify-content-around">
                <span>Nom : <?php echo $profil->{'nom'} ?> </span>
                <span>Prénom : <?php echo $profil->{'prenom'} ?></span>
            </div>
            <div class="d-flex justify-content-around">
                <span>Mail : <?php echo $profil->{'mail'} ?></span>
            </div>
            <div>
                <a href="/profil/modifier">Modifier mes imformations</a>
            </div>
        </section>
    </div>
    <div class="container my-2">
        <div>
            <h4>Mes commentaires</h4>
        </div>
        <div>
            <section>
                <ul>
                    <?php foreach ($comments as $key => $value) : ?>
                        <li><?php echo $value['content'] ?> <a href="/article?id=<?php echo $value['articleId'] ?>">Voir l'article</a></li>
                    <?php endforeach ?>
                </ul>
            </section>
        </div>
    </div>
    <?php if ($session->get('editor') == true) : ?>
        <div class="container my-2">
            <div>
                <h4>Mes articles</h4>
            </div>
            <div>
                <section>
                    <ul>
                        <?php foreach ($articles as $key => $value) : ?>
                            <li><?php echo $value['titre'] ?> <a href="/article?id=<?php echo $value['id'] ?>">Voir l'article</a></li>
                        <?php endforeach ?>
                    </ul>
                </section>
            </div>
        </div>
    <?php endif ?>
</div>