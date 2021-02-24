<?php $pattern = '(?:[a-z0-9!#$%&\'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])' ?>

<div class="container mt-5 mb-5">
    <div class="row d-flex align-items-center justify-content-center">
        <form class="col-md-6" method="POST">
            <div class="formRegister px-5 py-5">
                <h5 class="mt-3">Inscrivez-vous</h5>
                <p class="mt-2 text-muted">Cela vous donne la possibilité de laisser des commentaires sur les articles</p>
                <div class="form-input"> <i class="fa fa-envelope"></i> <input type="mail" class="form-control" placeholder="Votre mail" name="mail" required pattern="<?php echo $pattern ?>"> </div>
                <div class="form-input"> <i class="fa fa-user"></i> <input type="text" class="form-control" placeholder="Votre nom" name="nom" required pattern="^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$"> </div>
                <div class="form-input"> <i class="fa fa-user"></i> <input type="text" class="form-control" placeholder="Votre prenom" name="prenom" required pattern="^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$"> </div>
                <div class="form-input"> <i class="fa fa-lock"></i> <input type="password" class="form-control" placeholder="Mot de passe" name="mdp" id="password" onkeyup='check()' required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"> </div>
                <div class="form-input"> <i class="fa fa-lock"></i> <input type="password" class="form-control" placeholder="Mot de passe" name="confirmpwd" id="confirmpwd" onkeyup='check()' required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"> </div>
                <div class="row text-center">
                    <small>Le mot de passe doit contenir au moins 8 caratères dont une majuscule, une minuscule, un chiffre et un caratère spécial comme $!%*?&</small>
                    <span id='message'></span>
                </div>
                <input type="hidden" name="role" value="user">
                <input type="submit" class="btn btn-info col-3 signup rounded-pill" value="S'inscrire" name="regist">
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="/public/js/app.js"></script>