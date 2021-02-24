<div class="container mt-5 mb-5">
    <div class="row d-flex align-items-center justify-content-center">
        <form class="col-md-6" method="POST">
            <div class="formRegister px-5 py-5">
                <h5 class="mt-3">Inscrivez-vous</h5> <small class="mt-2 text-muted">Cela vous donne la possibilité de laisser des commentaires sur les articles</small>
                <div class="form-input"> <i class="fa fa-envelope"></i> <input type="text" class="form-control" placeholder="Votre mail" name="mail"> </div>
                <div class="form-input"> <i class="fa fa-user"></i> <input type="text" class="form-control" placeholder="Votre nom" name="nom"> </div>
                <div class="form-input"> <i class="fa fa-user"></i> <input type="text" class="form-control" placeholder="Votre prenom" name="prenom"> </div>
                <div class="form-input"> <i class="fa fa-lock"></i> <input type="password" class="form-control" placeholder="Mot de passe" name="mdp" id="password" onkeyup='check()'> </div>
                <div class="form-input"> <i class="fa fa-lock"></i> <input type="password" class="form-control" placeholder="Mot de passe" name="confirmpwd" id="confirmpwd" onkeyup='check()'> </div>
                <div class="row text-center">
                    <span id='message'></span>
                </div>
                <input type="hidden" name="role" value="user">
                <input type="submit" class="btn btn-info col-3 signup" value="S'inscrire" name="regist">
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="/public/js/app.js"></script>