<div class="container-fluid my-4 h-100">
    <div class="row">
        <div class="col offset-1 col-md-5 text-center">
            <h3><?php echo $article->titre;
                ?></h3>
            <div>
                <img style="border-radius: 10px; width:650px" src="<?php echo $article->img_url ?>" alt="">
            </div>
            <p class="mt-3">
                <?php echo $article->contenu
                ?>
            </p>
        </div>
    </div>
</div>