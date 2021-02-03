<div class="container-fluid mb-5 mt-1">
    <div class="row">
        <form action="" method="POST" class="d-flex flex-column align-items-center w-100" enctype="multipart/form-data">
            <h4>Vous pouvez modifier votre article ici</h4>
            <input style="height: 50px;" class="col-5 my-2" type="text" name="titre" value="<?php echo $article->titre;
                                                                                            ?>">
            <textarea style="height: 100px;" class="col-5 my-2" name="contenu"><?php echo $article->contenu
                                                                                ?></textarea>
            <div class="col-5 my-2">
                <div class="row text-center">
                    <img src="<?php echo $article->img_url ?>" style="border-radius: 10px; width:650px" alt="">
                    <label for="img">Sélectionnez votre image</label>
                    <input type="file" name="img" accept="image/png, image/jpeg">
                </div>
            </div>
            <input type="submit" class="btn btn-info col-2" value="Modifier" name="modifier">
        </form>
    </div>
</div>