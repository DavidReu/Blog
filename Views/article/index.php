<?php

foreach ($articles as $key => $valeur) {
?>
    <div class="border my-4">
        <div class="p-4">
            <h3><?php echo $valeur["titre"]
                ?>
            </h3>
            <div>
                <img style="width:300px!important" src="<?php echo $valeur['img_url']
                                                        ?> " alt="">
            </div>
            <p class="mt-3">
                <?php echo $valeur["contenu"]
                ?>
            </p>
            <div>
                <?php if ($_SESSION['admin'] == false) : ?>
                    <a class="btn btn-info" href="./index.php?article=<?php echo $valeur["id"] ?>">Lire l'article</a>
                <?php else : ?>
                    <a class="btn btn-info" href="./index.php?update=<?php echo $valeur["id"] ?>">Modifier l'article</a>
                    <form action="" method="POST">
                        <input type="hidden" name="id" value="<?php echo $valeur["id"] ?> ">
                        <input type="submit" value="Supprimer" name="delete" class="btn btn-info my-2">
                    </form>
                <?php endif ?>
            </div>
        </div>
    </div>
<?php
}
?>