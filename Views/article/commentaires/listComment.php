<div>
    <div>
        <h4>Liste des commentaires de chaque utilisateurs et le titre de l'article</h4>
    </div>
    <div class="container-fluid">
        <form action="" method="GET" class="d-flex">
            <select class="form-select w-25" name="article" id="articles-select">
                <option value="all">Tous les articles</option>
                <?php foreach ($articles as $key => $value) : ?>
                    <option value="<?php echo $value['id'] ?>"><?php echo $value['titre'] ?></option>
                <?php endforeach ?>
            </select>
            <button class="btn btn-info mx-2" type="submit">Filtrer</button>
        </form>
        <div class="d-flex justify-content-center">
            <table class="text-center col-md-12 mt-3 table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Commentaire</th>
                        <th>Titre de l'article</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comments as $key => $value) : ?>
                        <tr class="rowComment-<?php echo $value['id'] ?> align-middle">
                            <td><?php echo $value['nom'] ?></td>
                            <td><?php echo $value['prenom'] ?></td>
                            <td class="w-50"><?php echo $value['content'] ?></td>
                            <td><?php echo $value['titre'] ?></td>
                            <td>
                                <form action="" class="d-flex justify-content-around">
                                    <button class="deleteComment btn btn-info" type="submit" name="delete" value="<?php echo $value['id'] ?>">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>