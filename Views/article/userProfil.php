<?php

use Symfony\Component\HttpFoundation\Session\Session;

$session = new Session();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col col-3 bg-light p-3 text-center" style="height: 100vh;">
            <section>
                <h4>Mon profil</h4>
                <?php ?>
                <div class="d-flex flex-column">
                    <span>Nom : <?php echo $profil->{'nom'} ?> </span>
                    <span>Prénom : <?php echo $profil->{'prenom'} ?></span>
                    <span>Mail : <?php echo $profil->{'mail'} ?></span>
                </div>
                <div>
                    <a href="/profil/modifier">Modifier mes imformations</a>
                </div>
            </section>
        </div>
        <div class="my-3 col offset-1 col-6">
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
            <?php if ($session->get('editor') == true) : ?>
                <div class="mt-5">
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
    </div>

</div>