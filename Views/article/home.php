<?php

use Symfony\Component\HttpFoundation\Session\Session;

$session = new Session();

?>
<div class="container-fluid">
    <div class="row d-flex justify-content-center m-4">
        <?php foreach ($articles as $key => $valeur) : ?>
            <div class="card col-md-5 m-3 py-2 border border-info" style="width: 20rem;">
                <img src="<?php echo $valeur['img_url'] ?>" class="card-img-top h-50 rounded">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $valeur["titre"] ?></h5>
                    <p class="card-text"><?php echo $valeur["contenu"] ?></p>
                </div>
                <div>
                    <?php if ($session->get('admin') == false) : ?>
                        <a class="btn btn-info" href="article?id=<?php echo $valeur["id"] ?>">Lire l'article</a>
                    <?php elseif ($session->get('admin') == true) : ?>
                        <a class="btn btn-info" href="article/update?id=<?php echo $valeur["id"] ?>">Modifier l'article</a>
                        <form action="delete" method="POST">
                            <input type="hidden" name="id" value="<?php echo $valeur["id"] ?> ">
                            <input type="submit" value="Supprimer" name="delete" class="btn btn-info my-2">
                        </form>
                    <?php endif ?>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>