<?php

namespace App\Controllers;

use App\Models\PdoModel;
use App\Models\ArticleModel;

class ArticleController
{

    public function render($path, $tab = [])
    {
        // Récupère les données et les extrait sous forme de variables
        extract($tab);



        ob_start();
        /**
         * Tout ce qui se trouve après ob_start sera enregistrer dans la variable $content grâce à ob_get_clean 
         * et la variable $content est utilisé dans le template
         */
        // Crée le chemin et inclut le fichier de vue
        require_once($path);

        $content = ob_get_clean();
        require('/Applications/MAMP/htdocs/stage/blog/Views/template.php');
    }

    public function home()
    {
        $myPDO = new PdoModel();
        $pdo = $myPDO->getPDO();
        $articleModel = new ArticleModel($pdo);
        $articles = $articleModel->getAllArticle();
        $this->render(ROOT . 'Views/article/index.php', ['articles' => $articles]);
    }

    public function showarticle($id)
    {
        $myPDO = new PdoModel();
        $pdo = $myPDO->getPDO();
        $articleModel = new ArticleModel($pdo);
        $article = $articleModel->getArticleById($id);
        $this->render(ROOT . 'Views/article/single.php', ['article' => $article]);
    }

    public function createForm()
    {
        $myPDO = new PdoModel();
        $pdo = $myPDO->getPDO();
        $articleModel = new ArticleModel($pdo);
        if (isset($_POST['poster'])) {
            $articleModel->create($_POST['titre'], $_POST['contenu'], '/stage/blog/upload/' . $_FILES['img']['name']);

            if ((isset($_FILES["img"]))) {
                $dossier = ROOT . 'upload/';
                $fichier = basename($_FILES['img']['name']);
                move_uploaded_file($_FILES["img"]["tmp_name"], $dossier . $fichier);
            }
        }
        $this->render(ROOT . 'Views/article/formcreate.php', ['article' => '']);
    }

    public function formUpdate($id)
    {
        $myPDO = new PdoModel();
        $pdo = $myPDO->getPDO();
        $articleModel = new ArticleModel($pdo);
        $article = $articleModel->getArticleById($id);

        if (isset($_POST['modifier'])) {
            $id = $_GET['update'];
            $articleModel->update($id, $_POST['titre'], $_POST['contenu'], '/stage/blog/upload/' . $_FILES['img']['name']);
            $article = $articleModel->getArticleById($id);
        }
        $this->render(ROOT . 'Views/article/formUpdate.php', ['article' => $article]);
    }

    public function delete($id)
    {
        $myPDO = new PdoModel();
        $pdo = $myPDO->getPDO();
        $articleModel = new ArticleModel($pdo);
        $articleModel->delete($id);
    }
}
