<?php 
if(isset($response)){
    echo '<div class="card '.$response['bg-color'].'">
    <div class="card-body">
      '.$response['message'].'
    </div>
  </div>';
}
?>
<div class="container-fluid">
    <h5 class="text-center">Créez votre article</h5>
    <div class="container">
        <div class="row">
            <form action="/article/new" method="POST" class="d-flex flex-column align-items-center" enctype="multipart/form-data">
                <input class="col-4 my-2" type="text" name="titre" placeholder="Titre">
                <textarea class="col-4 my-2" name="contenu" placeholder="Contenu"></textarea>
                <div class="col-4 my-2">
                    <div class="row text-center">
                        <label for="img">Sélectionnez votre image</label>
                        <input type="file" name="img" accept="image/png, image/jpeg">
                    </div>
                </div>
                <input type="submit" class="btn btn-info col-1" value="Poster" name="poster">
            </form>
        </div>
    </div>
</div>