<div>
    <div class="text-center my-3">
        <h4>Liste des utilisateurs inscris sur le site</h4>
    </div>
    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <table class="text-center col-md-12 mt-3 table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Mail</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $key => $value) : ?>
                        <tr class="rowUser-<?php echo $value['id'] ?>">
                            <td><?php echo $value['nom'] ?></td>
                            <td><?php echo $value['prenom'] ?></td>
                            <td><?php echo $value['mail'] ?></td>
                            <td>
                                <div>
                                    <form class="d-flex justify-content-around">
                                        <a class="btn btn-info" href="/userUpdate?id=<?php echo $value['id'] ?>">Modifier</a>
                                        <input type="hidden" name="userId" value="<?php echo $value['id'] ?>">
                                        <button class="deleteUser btn btn-info" type="submit" name="delete" value="<?php echo $value['id'] ?>">Supprimer</button>
                                    </form>
                                </div>

                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>