<div class="container-fluid mb-5 mt-1">
    <div class="row">
        <form action="" method="POST" class="d-flex flex-column align-items-center w-100" enctype="multipart/form-data">
            <h4>Modifiez les informations de l'utilisateur</h4>
            <label for="nom">Nom</label>
            <input class="col-5 my-2" type="text" name="nom" value="<?php echo $user->nom; ?>">
            <label for="prenom">Prénom</label>
            <input class="col-5 my-2" name="prenom" value="<?php echo $user->prenom ?>">
            <label for="mail">Email</label>
            <input class="col-5 my-2" type="text" name="mail" value="<?php echo $user->mail ?>">
            <input type="submit" class="btn btn-info col-2" value="Modifier" name="modifier">
        </form>
    </div>
</div>