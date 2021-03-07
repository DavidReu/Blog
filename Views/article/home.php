<?php

use Symfony\Component\HttpFoundation\Session\Session;

$session = new Session();

?>
<div class="container-fluid">
    <div class="row d-flex justify-content-center m-4">
        <?php foreach ($articles as $key => $valeur) : ?>
            <div class="card col-md-3 m-3 p-0 rounded">
                <img src="<?php echo $valeur['img_url'] ?>" class="card-img-top h-75" alt="image lié à l'article">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $valeur["titre"] ?></h5>
                    <p class="card-text preview"><?php echo $valeur["contenu"] ?></p>
                </div>
                <div class="d-flex justify-content-around">
                    <?php if ($session->get('admin') == false) : ?>
                        <span>Auteur : <?php echo $valeur['prenom'] ?></span>
                        <a class="text-info fas fa-arrow-right" href="/article?id=<?php echo $valeur["id"] ?>"> Lire l'article</a>
                    <?php elseif ($session->get('admin') == true) : ?>
                        <span>
                            <a class="btn rounded-pill primaryColor my-2" href="article/update?id=<?php echo $valeur["id"] ?>">Modifier l'article</a>
                        </span>
                        <form action="delete" method="POST">
                            <input type="hidden" name="id" value="<?php echo $valeur["id"] ?> ">
                            <input type="submit" value="Supprimer" name="delete" class="btn rounded-pill primaryColor my-2">
                        </form>
                    <?php endif ?>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>