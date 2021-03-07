<?php

use Symfony\Component\HttpFoundation\Session\Session;

$session = new Session(); ?>
<div class="container-fluid my-4 h-100">
    <div class="row">
        <div>
            <img class="m-2" style="border-radius: 10px; width:40%; float:left;" src="<?php echo $article->img_url ?>" alt="">
            <div class="px-4">
                <h3 class="text-center">
                    <?php echo $article->titre; ?>
                </h3>
                <p class="mt-3">
                    <?php echo $article->contenu
                    ?>
                </p>
            </div>
        </div>
        <!-- <div class="col offset-1 col-md-5">
            <div>
                <img style="border-radius: 10px; width:100%" src="<?php// echo $article->img_url ?>" alt="">
            </div>

        </div>
        <div class="col col-md-5 text-center">
            <h3>
                <?php// echo $article->titre; ?>
            </h3>
            <p class="mt-3">
                <?php// echo $article->contenu
                ?>
            </p>
        </div> -->
    </div>

    <!---------- Modification article ---------->
    <?php if ($session->get('userId') == $article->user_id) : ?>
        <div class="row text-center">
            <a href="article/update?id=<?php echo $article->id ?>"><span>Vous pouvez modifier votre article ici </span></a>
        </div>
    <?php endif ?>
    <!------------------------------------------>

    <!---------- Ajout commentaire ---------->
    <div class=" row d-flex justify-content-center my-5">
        <?php if ($session->get('user') == true || $session->get('admin') == true || $session->get('editor') == true) {
            include('commentaires/commentCreate.php');
        } else { ?>
            <div class="col-md-5 align-self-center text-center">
                <h4> Si cette article vous plaît et que vous souhaitez laisser un commentaire ou donner votre opinion vous pouvez vous inscrire</h4>
            </div>
        <?php }
        ?>
    </div>
    <!---------------------------------------->

    <!---------- Partie commentaire ---------->
    <div class="row d-flex justify-content-around">
        <?php foreach ($commentaires as $key => $valeur) { ?>
            <div class="col-md-5 text-center border border-info rounded my-2">
                <p><?php echo $valeur['content'] ?></p>
                <div>
                    <span>Par : <?php echo $valeur['nom'] ?></span>
                    <span><?php echo $valeur['prenom'] ?></span>
                </div>
                <?php if ($session->get("userId") == $valeur['usersId']) : ?>
                    <button class="btn btn-info btn-small my-2" value="<?php echo $valeur['id'] ?>" type="submit" data-bs-toggle="modal" data-bs-target="#editModal" name="edit">Editer</button>
                    <!-- Modal -->
                    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modifier votre commentaire</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="updateComment" method="POST">
                                    <div class="modal-body row text-center justify-content-center">
                                        <label for="newComment">Entrez votre nouveau commentaire ici</label>
                                        <textarea class="w-75" type="text" name="newContent" rows="3" placeholder="<?php echo $valeur['content'] ?>"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        <input type="hidden" name="commentId" value="<?php echo $valeur['id'] ?>">
                                        <input type="hidden" name="articleId" value="<?php echo $valeur['articleId'] ?>">
                                        <input type="submit" class="btn btn-primary" name="editComment" value="Enregistrer modification">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Fin Modal-->
                <?php endif ?>
            </div>
        <?php } ?>
    </div>
</div>