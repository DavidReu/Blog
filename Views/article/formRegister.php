<div class="container mt-5 mb-5">
    <div class="row d-flex align-items-center justify-content-center">
        <form class="col-md-6" method="POST" name="myForm">
            <div class="formRegister px-5 py-5">
                <h5 class="mt-3">Inscrivez-vous</h5>
                <p class="mt-2 text-muted">Cela vous donne la possibilité de laisser des commentaires sur les articles</p>
                <div class="form-input"> <i class="fa fa-envelope"></i> <input type="email" class="form-control" placeholder="Votre mail" name="mail" required pattern='^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$'> </div>
                <div class="form-input"> <i class="fa fa-user"></i> <input type="text" class="form-control" placeholder="Votre nom" name="nom" required pattern="^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$"> </div>
                <div class="form-input"> <i class="fa fa-user"></i> <input type="text" class="form-control" placeholder="Votre prenom" name="prenom" required pattern="^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$"> </div>
                <div class="form-input"> <i class="fa fa-lock"></i> <input type="password" class="form-control" placeholder="Mot de passe" name="mdp" id="password" onkeyup='check()' required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"> </div>
                <div class="form-input"> <i class="fa fa-lock"></i> <input type="password" class="form-control" placeholder="Mot de passe" name="confirmpwd" id="confirmpwd" onkeyup='check()' required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"> </div>
                <div class="row text-center">
                    <small>Le mot de passe doit contenir au moins 8 caratères dont une majuscule, une minuscule, un chiffre et un caratère spécial comme $!%*?&</small>
                    <span id='message'></span>
                </div>
                <input type="hidden" name="role" value="user">
                <input type="submit" class="btn primaryColor col-3 signup rounded-pill" value="S'inscrire" name="regist">
            </div>
        </form>
    </div>
</div>
<script src="/public/js/app.js"></script>