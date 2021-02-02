<?php

/* require_once('/Applications/MAMP/htdocs/stage/blog/Models/ArticleModel.php');
//require_once('../Models/articleModel.php');
require_once('/Applications/MAMP/htdocs/stage/blog/Controllers/PdoController.php');

session_start();
$_SESSION['url'] = $_SERVER['PHP_SELF'];
$_SESSION['uri'] = $_SERVER['REQUEST_URI']; */

namespace App\Controllers;

//use App\Controllers\PdoController;
use App\Models\ArticleModel;

class ArticleController
{

    //private $mamp = '/Applications/MAMP/htdocs/';
    public function render($path, $tab)
    {
        // Récupère les données et les extrait sous forme de variables
        extract($tab);



        ob_start();
        /**
         * Tout ce qui se trouve après ob_start sera enregistrer dans la variable $content grâce à ob_get_clean 
         * et la variable $content est utilisé dans le template
         */
        var_dump($_GET['article']);
        if (isset($_GET['article']) && $_GET['article'] != 'new') {
            $_SESSION['id'] = $_GET['article']; ?>
            <div class="container-fluid my-4">
                <div class="row">
                    <div class="col offset-1 col-md-5 text-center">
                        <h3><?php echo $article->titre;
                            ?></h3>
                        <div>
                            <img style="border-radius: 10px; width:650px" src="<?php echo $article->img_url ?>" alt="">
                        </div>
                        <p class="mt-3">
                            <?php echo $article->contenu
                            ?>
                        </p>
                    </div>
                    <div class="col col-md-6 d-flex justify-content-center align-items-center">
                        <form action="./Controllers/formulaireUpdateController.php" method="POST" class="d-flex flex-column align-items-center w-100 " enctype="multipart/form-data">
                            <h4>Vous pouvez modifier votre article ici</h4>
                            <input style="height: 50px;" class="col-5 my-2" type="text" name="titre" placeholder="<?php echo $article->titre; ?>">
                            <textarea style="height: 100px;" class="col-5 my-2" name="contenu" placeholder="<?php echo $article->contenu ?>"></textarea>
                            <div class="col-5 my-2">
                                <div class="row text-center">
                                    <label for="img">Sélectionnez votre image</label>
                                    <input type="file" name="img" accept="image/png, image/jpeg">
                                </div>
                            </div>
                            <input type="submit" class="btn btn-info col-2" value="Modifier" name="modifier">
                        </form>
                    </div>
                </div>
            </div>
            <?php
            if ($_GET['article'] == 'new') { ?>
                <div class="container-fluid">
                    <h5 class="text-center">Créez votre article</h5>
                    <div class="container">
                        <div class="row">
                            <form action="../Controllers/formulaireCreateController.php" method="POST" class="d-flex flex-column align-items-center" enctype="multipart/form-data">
                                <input class="col-4 my-2" type="text" name="titre" placeholder="Titre">
                                <textarea class="col-4 my-2" name="contenu" placeholder="Contenu"></textarea>
                                <div class="col-4 my-2">
                                    <div class="row text-center">
                                        <label for="img">Sélectionnez votre image</label>
                                        <input type="file" name="img" accept="image/png, image/jpeg">
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-info col-1" value="Poster" name="poster">
                            </form>
                        </div>
                    </div>
                </div>
            <?php }
        } else {
            foreach ($articles as $key => $valeur) { ?>
                <div class="border my-4">
                    <div class="p-4">
                        <h3><?php echo $valeur["titre"] ?>
                        </h3>
                        <div>
                            <img style="width:300px!important" src="<?php echo $valeur['img_url'] ?> " alt="">
                        </div>
                        <p>
                            <?php echo $valeur["contenu"]
                            ?>
                        </p>
                        <a class="btn btn-info" href="./index.php?article=<?php echo $valeur["id"] ?>">Lire l'article</a>
                    </div>
                </div>
<?php
            }
        }
        $content = ob_get_clean();
        require('/Applications/MAMP/htdocs/stage/blog/Views/template.php');

        // Crée le chemin et inclut le fichier de vue
        require_once($path . '.php');
    }

    public function home()
    {
        var_dump(new PdoController());
        $myPDO = new PdoController();
        $pdo = $myPDO->getPDO();
        $articleModel = new ArticleModel($pdo);
        $articles = $articleModel->getAllArticle();
        $this->render('/Applications/MAMP/htdocs/stage/blog/index', ['articles' => $articles]);
        //require('/Applications/MAMP/htdocs/stage/blog/Views/indexContent.php');
    }

    public function showarticle($id)
    {
        $myPDO = new PdoController();
        $pdo = $myPDO->getPDO();
        $articleModel = new ArticleModel($pdo);
        $article = $articleModel->getArticleById($id);
        $this->render('/Applications/MAMP/htdocs/stage/blog/index', ['article' => $article]);
        //require('/Applications/MAMP/htdocs/stage/blog/Views/indexContent.php');
    }

    public function createForm()
    {
        $myPDO = new PdoController();
        $pdo = $myPDO->getPDO();
        $articleModel = new ArticleModel($pdo);
        if (isset($_POST['poster'])) {
            $articleModel->create($_POST['titre'], $_POST['contenu'], '/stage/blog/upload/' . $_FILES['img']['name']);

            if ((isset($_FILES["img"]))) {
                $dossier = '../upload/';
                $fichier = basename($_FILES['img']['name']);
                move_uploaded_file($_FILES["img"]["tmp_name"], $dossier . $fichier);
            }
        }
        $this->render('/Applications/MAMP/htdocs/stage/blog/index', ['article' => '']);
    }
}
