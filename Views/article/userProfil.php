<div class="container-fluid">
    <div class="row">
        <h4>Mon profil</h4>
    </div>
    <div class="row">
        <section class="w-50">
            <?php ?>
            <div class="d-flex justify-content-around">
                <span>Nom : <?php echo $profil->{'nom'} ?> </span>
                <span>Prénom : <?php echo $profil->{'prenom'} ?></span>
            </div>
            <div class="d-flex justify-content-around">
                <span>Mail : <?php echo $profil->{'mail'} ?></span>
            </div>
            <div>
                <a href="/profil/modifier">Modifier mes imformations</a>
            </div>
        </section>
    </div>
    <div>
        <h4>Mes commentaires</h4>
    </div>
    <div>
        <section>
            <ul>
                <?php foreach ($comments as $key => $value) : ?>
                    <li><?php echo $value['content'] ?></li>
                <?php endforeach ?>
            </ul>
        </section>
    </div>
</div>