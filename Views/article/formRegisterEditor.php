<div class="container mt-5 mb-5">
    <div class="row d-flex align-items-center justify-content-center">
        <form class="col-md-6" method="POST">
            <div class="formRegister px-5 py-5">
                <h5 class="mt-3">Inscrivez un rédacteur</h5> <small class="mt-2 text-muted">Un rédacteur aura la possibilité d'écrire un article sur le blog ou de laisser un commentaire</small>
                <div class="form-input"> <i class="fa fa-envelope"></i> <input type="mail" class="form-control" placeholder="Votre mail" name="mail" required pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$"> </div>
                <div class="form-input"> <i class="fa fa-user"></i> <input type="text" class="form-control" placeholder="Votre nom" name="nom" required pattern="^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$"> </div>
                <div class="form-input"> <i class="fa fa-user"></i> <input type="text" class="form-control" placeholder="Votre prenom" name="prenom" required pattern="^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$"> </div>
                <div class="form-input"> <i class="fa fa-lock"></i> <input type="password" class="form-control" placeholder="Mot de passe" name="mdp" id="password" onkeyup='check()' required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"> </div>
                <div class="form-input"> <i class="fa fa-lock"></i> <input type="password" class="form-control" placeholder="Mot de passe" name="confirmpwd" id="confirmpwd" onkeyup='check()' required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"> </div>
                <div class="row text-center">
                    <small>Le mot de passe doit contenir au moins 8 caratères dont une majuscule, une minuscule, un chiffre et un caratère spécial comme $!%*?&</small>
                    <span id='message'></span>
                </div>
                <input type="hidden" name="role" value="editor">
                <input type="submit" class="btn btn-info col-3 signup" value="Inscrire" name="registEditor">
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="/public/js/app.js"></script>


<!-- <div class="container-fluid">
    <h5 class="text-center">Inscrivez un rédacteur</h5>
    <p class="text-center">Un rédacteur aura la possibilité d'écrire un article sur le blog ou de laisser un commentaire</p>
    <div class="container">
        <div class="row">
            <form action="" method="POST" class="d-flex flex-column align-items-center" enctype="multipart/form-data">
                <input class="col-4 my-2" type="text" name="nom" placeholder="Votre nom">
                <input class="col-4 my-2" type="text" name="prenom" placeholder="Votre prénom">
                <input class="col-4 my-2" type="text" name="mail" placeholder="Votre mail">
                <input id="password" class="col-4 my-2" type="password" name="mdp" placeholder="Entrez un mot de passe" onkeyup='check()'></input>
                <input id="confirmpwd" class="col-4 my-2" type="password" name="confirmpwd" placeholder="Confirmez le mot de passe" onkeyup='check()'></input>
                <span id='message'></span>
                <input type="hidden" name="role" value="editor">
                <input type="submit" class="btn btn-info col-1" value="S'inscrire" name="registEditor">
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="/public/js/app.js"></script> -->