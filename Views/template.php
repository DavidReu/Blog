<!DOCTYPE html>
<html>
<!-- Template utilisé pour toutes les pages -->

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" aria-current="page" href="/stage/blog/index.php">Accueil</a>
                        <a class="nav-link" href="/stage/blog/index.php?article=new">Articles</a>
                        <a class="nav-link" href="user.php">Ma Page</a>
                    </div>
                </div>
                <form action="Controllers/connexion.php" method="POST" class="d-flex flex-column">
                    <input type="text" name="email" placeholder="Email">
                    <input type="password" name="mdp" placeholder="Mot de passe">
                    <button class="btn btn-info" type="submit" name="connexion">Connexion</button>
                </form>
            </div>
        </nav>
        <div>
            <h1 class="text-center">
                <?php $heure = date("H");
                if ($heure < 18) {
                    echo 'Bonjour';
                } else {
                    echo 'Bonsoir';
                }
                ?>
            </h1>
        </div>
    </header>

    <?php
    echo $content;
    ?>

</body>

</html>