<div class="col-md-5">
    <h5 class="text-center">Laissez un commentaire</h5>
    <form action="commentaire" method="POST" class="d-flex flex-column align-items-center w-100" enctype="multipart/form-data">
        <textarea class="col-4 my-2 w-75" name="content" placeholder="Votre commentaire" rows="5"></textarea>
        <input type="hidden" name="id" value="<?php echo $article->id ?>">
        <input type="submit" class="btn btn-info col-3" value="Poster" name="poster">
    </form>
    <?php if ($session->get('userId') == $article->user_id) { ?>
        <div class="container d-flex flex-column justify-content-center align-items-center mt-5">
            <h4>Vous pouvez modifier votre article ici</h4>
            <a class=" btn btn-info" href="article/update?id=<?php echo $article->id ?>">Modifier l'article</a>
        </div>
    <?php } ?>
</div>