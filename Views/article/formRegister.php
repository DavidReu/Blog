<div class="container-fluid">
    <h5 class="text-center">Inscrivez vous</h5>
    <p class="text-center">Être inscrit vous permet de commenter les différents articles présents sur le blog</p>
    <div class="container">
        <div class="row">
            <form action="" method="POST" class="d-flex flex-column align-items-center" enctype="multipart/form-data">
                <input class="col-4 my-2" type="text" name="nom" placeholder="Votre nom">
                <input class="col-4 my-2" type="text" name="prenom" placeholder="Votre prénom">
                <input class="col-4 my-2" type="text" name="mail" placeholder="Votre mail">
                <input id="password" class="col-4 my-2" type="password" name="mdp" placeholder="Entrez un mot de passe" onkeyup='check()'></input>
                <input id="confirmpwd" class="col-4 my-2" type="password" name="confirmpwd" placeholder="Confirmez le mot de passe" onkeyup='check()'></input>
                <span id='message'></span>
                <input type="submit" class="btn btn-info col-1" value="S'inscrire" name="regist">
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="/public/js/app.js"></script>