<?php

use Symfony\Component\HttpFoundation\Session\Session;

$session = new Session(); ?>
<div class="container-fluid my-4 h-100">
    <div class="row">
        <div class="col offset-1 col-md-5 text-center">
            <h3><?php echo $article->titre;
                ?></h3>
            <div>
                <img style="border-radius: 10px; width:100%" src="<?php echo $article->img_url ?>" alt="">
            </div>
            <p class="mt-3">
                <?php echo $article->contenu
                ?>
            </p>
        </div>
        <?php if ($session->get('user') == true || $session->get('admin') == true) {
            include('commentaires/commentCreate.php');
        } else { ?>
            <div class="col-md-5 align-self-center text-center">
                <h4> Si cette article vous plaît et que vous souhaitez laisser un commentaire ou donner votre opinion vous pouvez vous inscrire</h4>
            </div>
        <?php }
        ?>
    </div>

    <div class="row d-flex justify-content-around">
        <?php foreach ($commentaires as $key => $valeur) { ?>
            <div class="col-md-5 text-center border border-info rounded my-2">
                <p><?php echo $valeur['content'] ?></p>
                <div>
                    <span>Par : <?php echo $valeur['nom'] ?></span>
                    <span><?php echo $valeur['prenom'] ?></span>
                </div>
            </div>
        <?php } ?>
    </div>
</div>