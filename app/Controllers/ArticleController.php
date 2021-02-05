<?php

namespace App\Controllers;

use App\Models\PdoModel;
use App\Models\ArticleModel;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\HttpFoundation\File\UploadedFile;



class ArticleController
{

    public function render($path, $tab = [])
    {

        //$response = new Response();
        //$response->headers->set('Content-Type', "application/json");
        //dd($response);
        //return $response->send();
        // Récupère les données et les extrait sous forme de variables
        extract($tab);


        // Crée le chemin et inclut le fichier de vue
        ob_start();
        include(ROOT . 'Views/article/' . $path . '.php');
        //$response->setContent(json_encode(["data" => "bouh"]));
        /**
         * Tout ce qui se trouve après ob_start sera enregistrer dans la variable $content grâce à ob_get_clean 
         * et la variable $content est utilisé dans le template
         */


        $content = new Response();
        //$content = ob_get_clean();
        include(ROOT . 'Views/template.php');
        return $content;
    }

    public function home()
    {
        $myPDO = new PdoModel();
        $pdo = $myPDO->getPDO();
        $articleModel = new ArticleModel($pdo);
        $articles = $articleModel->getAllArticle();
        $response = $this->render('home', ['articles' => $articles]);
        $response->send();
    }

    public function showarticle(Request $request)
    {
        $id = $request->get('id');
        $myPDO = new PdoModel();
        $pdo = $myPDO->getPDO();
        $articleModel = new ArticleModel($pdo);
        $article = $articleModel->getArticleById($id);
        $this->render(ROOT . 'Views/article/single.php', ['article' => $article]);
    }

    public function createForm(Request $request)
    {
        $myPDO = new PdoModel();
        $pdo = $myPDO->getPDO();
        $articleModel = new ArticleModel($pdo);
        $uri = $request->getPathInfo();
        var_dump($uri);

        $titre = $request->request->get('titre');
        $contenu = $request->request->get('contenu');
        $img = $request->files->get('img');
        //$upload = new UploadedFile($img);
        var_dump($img);
        //dd($titre, $contenu, $img);
        $articleModel->create($titre, $contenu, '/stage/blog/upload/' . $img);

        if (isset($img)) {
            $dossier = ROOT . 'upload/';
            $fichier = $img->originalName;
            move_uploaded_file($_FILES["img"]["tmp_name"], $dossier . $fichier);
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
            $id = $_GET['id'];
            $articleModel->update($id, $_POST['titre'], $_POST['contenu'], '/stage/blog/upload/' . $_FILES['img']['name']);
            $article = $articleModel->getArticleById($id);
        }
        $this->render(ROOT . 'Views/article/formUpdate.php', ['article' => $article]);
    }

    public function delete(Request $request)
    {
        $id = $request->request->get('id');
        $myPDO = new PdoModel();
        $pdo = $myPDO->getPDO();
        $articleModel = new ArticleModel($pdo);
        $articleModel->delete($id);
        (new RedirectResponse("/stage/blog/index.php"))->send();
    }
}
