<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use App\Controllers\Controller;
//use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Controllers\CommentaireController;
use App\Models\CommentaireModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;


class ArticleController extends Controller
{
    public function index(Logger $logger)
    {
        $logger->info('Tout va bien');
        $logger->error('Je ne peux pas trouver la voiture');
        $logger->critical(' Ça ne marche pas !');
    }

    public function home()
    {
        $articleModel = new ArticleModel();
        $articles = $articleModel->getAllArticle();
        $this->render('home', ['articles' => $articles]);
    }

    public function showarticle(Request $request)
    {
        $id = $request->get('id');
        if (isset($id)) {
            $articleModel = new ArticleModel();
            $commentaireModel = new CommentaireModel();
            $article = $articleModel->getArticleById($id);
            $commentaires = $commentaireModel->showCommentsByArticle($id);
            $results = ['article' => $article, 'commentaires' => $commentaires];
            $this->render('single', $results);
        } else {
            $jsonResponse = new JsonResponse(['success' => false, 'message' => 'aucune donnée renvoyée', "bg-color" => "bg-danger"], 200);
            $response = ['success' => false, 'message' => 'aucune donnée renvoyéé', 'bg-color' => 'bg-danger', 'statut' => 200];
            $this->render('single', ['response' => $response]);
        }
    }

    public function showForm()
    {
        $this->render('formcreate');
    }

    public function createForm(Request $request)
    {
        $articleModel = new ArticleModel();
        $uri = $request->getPathInfo();
        $poster = $request->get('poster');
        $longeur = strlen($request->request->get('titre'));

        if ($longeur > 0) {
            $titre = $request->request->get('titre');
            $contenu = $request->request->get('contenu');
            $titre = $this->valid($titre);
            $contenu = $this->valid($contenu);
            $img = $_FILES['img']['name'];
            $dossier = 'upload/';
            if (!empty($_FILES["img"]["tmp_name"])) {
                move_uploaded_file($_FILES["img"]["tmp_name"], $dossier . $img);
                $fichier = '/upload' . '/' . $img;
            } else {
                $jsonResponse = new JsonResponse(['success' => false, 'message' => 'aucune donnée renvoyée', "bg-color" => "bg-danger"], 200);
                $response = ['success' => false, 'message' => 'aucune donnée renvoyéé', 'bg-color' => 'bg-danger', 'statut' => 200];
                $this->render('formcreate', ['response' => $response]);
            }
            $articleModel->create($titre, $contenu, $fichier);
        } else {
            $logger = new Logger("create_article");
            $logger->pushHandler(new StreamHandler(__DIR__ . '/my_app.log', Logger::DEBUG));
            $logger->pushHandler(new FirePHPHandler());
            $logger->info('Tout va bien');
            $logger->error('Je ne peux pas trouver la voiture');
            $logger->critical(' Ça ne marche pas !');
            /* $jsonResponse = new JsonResponse(['success' => false, 'message' => 'aucune donnée renvoyée', "bg-color" => "bg-danger"], 200);
            $response = ['success' => false, 'message' => 'aucune donnée renvoyéé', 'bg-color' => 'bg-danger', 'statut' => 200];
            $this->render('formcreate', ['response' => $response]); */
        }
        (new RedirectResponse("/index.php"))->send();
    }

    public function formUpdate(Request $request)
    {
        $articleModel = new ArticleModel();
        $id = $request->get('id');
        $article = $articleModel->getArticleById($id);
        $modifier = $request->get('modifier');

        if (isset($modifier)) {
            $titre = $request->request->get('titre');
            $contenu = $request->request->get('contenu');
            $articleModel->update($id, $titre, $contenu, '/upload' . '/' . $_FILES['img']['name']);
            $article = $articleModel->getArticleById($id);
        } else {
            $jsonResponse = new JsonResponse(['success' => false, 'message' => 'aucune donnée renvoyée', "bg-color" => "bg-danger"], 200);
            $response = ['success' => false, 'message' => 'aucune donnée renvoyéé', 'bg-color' => 'bg-danger', 'statut' => 200];
            $this->render('formUpdate', ['response' => $response]);
        }
        $this->render('formUpdate', ['article' => $article]);
    }

    public function delete(Request $request)
    {
        $id = $request->request->get('id');
        $articleModel = new ArticleModel();
        $articleModel->delete($id);
        (new RedirectResponse("index.php"))->send();
    }
}
