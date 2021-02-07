<?php

namespace App\Controllers;

use App\Models\PdoModel;
use App\Models\ArticleModel;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\VarDumper\VarDumper;



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


        $content = new Response(ob_get_clean());
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
        $poster = $request->get('poster');

        if (isset($poster)) {
            $titre = $request->request->get('titre');
            $contenu = $request->request->get('contenu');
            $img = $_FILES['img']['name'];

            $dossier = ROOT . 'upload/';
            var_dump($dossier);
            move_uploaded_file($_FILES["img"]["tmp_name"], $dossier . $img);
            $fichier = '/stage/blog/upload/' . $img;
            $articleModel->create($titre, $contenu, $fichier);
        }
        $this->render('formcreate', ['article' => '']);
    }

    public function formUpdate(Request $request)
    {
        $myPDO = new PdoModel();
        $pdo = $myPDO->getPDO();
        $articleModel = new ArticleModel($pdo);
        $id = $request->get('id');
        $article = $articleModel->getArticleById($id);
        $modifier = $request->get('modifier');

        if (isset($modifier)) {
            $titre = $request->request->get('titre');
            $contenu = $request->request->get('contenu');
            $articleModel->update($id, $titre, $contenu, '/stage/blog/upload/' . $_FILES['img']['name']);
            $article = $articleModel->getArticleById($id);
        }
        $this->render('formUpdate', ['article' => $article]);
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
