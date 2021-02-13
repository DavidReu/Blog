<div class="col-md-5">
    <h5 class="text-center">Laissez un commentaire</h5>
    <form action="commentaire" method="POST" class="d-flex flex-column align-items-center w-100" enctype="multipart/form-data">
        <textarea class="col-4 my-2 w-75" name="content" placeholder="Votre commentaire" rows="5"></textarea>
        <input type="hidden" name="id" value="<?php echo $article->id ?>">
        <input type="submit" class="btn btn-info col-3" value="Poster" name="poster">
    </form>
</div>