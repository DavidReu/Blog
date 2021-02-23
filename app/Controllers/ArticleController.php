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
use Symfony\Component\HttpFoundation\Session\Session;

class ArticleController extends Controller
{
    public function home()
    {
        $articleModel = new ArticleModel();
        $articles = $articleModel->getAllArticle();
        $this->render('home', ['articles' => $articles]);
    }

    public function showarticle(Request $request)
    {
        $logger = new Logger("show_article");
        $logger->pushHandler(new StreamHandler('/var/www/html/my_app.log', Logger::DEBUG));
        $logger->pushHandler(new FirePHPHandler());

        $id = $request->get('id');
        if (isset($id)) {
            $articleModel = new ArticleModel();
            $commentaireModel = new CommentaireModel();
            $article = $articleModel->getArticleById($id);
            $commentaires = $commentaireModel->showCommentsByArticle($id);
            $results = ['article' => $article, 'commentaires' => $commentaires];
            $logger->info('Les données de l\'article ont bien été récupérées');
            $this->render('single', $results);
        } else {
            $logger->error('Aucune données envoyées');
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
        $session = new Session();

        $logger = new Logger("create_article");
        $logger->pushHandler(new StreamHandler('/var/www/html/my_app.log', Logger::DEBUG));
        $logger->pushHandler(new FirePHPHandler());

        if ($longeur > 0) {
            $titre = $request->request->get('titre');
            $contenu = $request->request->get('contenu');
            $titre = $this->valid($titre);
            $contenu = $this->valid($contenu);
            $img = $_FILES['img']['name'];
            $dossier = 'upload/';
            $userId = $session->get('userId');
            $logger->info('Tout va bien');
            if (!empty($_FILES["img"]["tmp_name"])) {
                move_uploaded_file($_FILES["img"]["tmp_name"], $dossier . $img);
                $fichier = '/upload' . '/' . $img;
            } else {
                $logger->error('Aucune images envoyées');
                /* $jsonResponse = new JsonResponse(['success' => false, 'message' => 'aucune donnée renvoyée', "bg-color" => "bg-danger"], 200);
                $response = ['success' => false, 'message' => 'aucune donnée renvoyéé', 'bg-color' => 'bg-danger', 'statut' => 200];
                $this->render('formcreate', ['response' => $response]); */
            }
            $articleModel->create($titre, $contenu, $fichier, $userId);
        } else {
            $logger->error('Aucune données envoyées');
            /* $jsonResponse = new JsonResponse(['success' => false, 'message' => 'aucune donnée renvoyée', "bg-color" => "bg-danger"], 200);
            $response = ['success' => false, 'message' => 'aucune donnée renvoyéé', 'bg-color' => 'bg-danger', 'statut' => 200];
            $this->render('formcreate', ['response' => $response]); */
        }
        (new RedirectResponse("/index.php"))->send();
    }

    public function formUpdate(Request $request)
    {
        $logger = new Logger("update_article");
        $logger->pushHandler(new StreamHandler('/var/www/html/my_app.log', Logger::DEBUG));
        $logger->pushHandler(new FirePHPHandler());

        $articleModel = new ArticleModel();
        $id = $request->get('id');
        $article = $articleModel->getArticleById($id);
        $modifier = $request->get('modifier');

        if (isset($modifier)) {
            $titre = $request->request->get('titre');
            $contenu = $request->request->get('contenu');
            $articleModel->update($id, $titre, $contenu, '/upload' . '/' . $_FILES['img']['name']);
            $logger->info('Modification effectuée');
            $article = $articleModel->getArticleById($id);
        } else {
            $logger->error('Echec de la moficiation');
            /* $jsonResponse = new JsonResponse(['success' => false, 'message' => 'aucune donnée renvoyée', "bg-color" => "bg-danger"], 200);
            $response = ['success' => false, 'message' => 'aucune donnée renvoyéé', 'bg-color' => 'bg-danger', 'statut' => 200];
            $this->render('formUpdate', ['response' => $response]); */
        }
        $this->render('formUpdate', ['article' => $article]);
    }

    public function delete(Request $request)
    {
        $logger = new Logger("delete_article");
        $logger->pushHandler(new StreamHandler('/var/www/html/my_app.log', Logger::DEBUG));
        $logger->pushHandler(new FirePHPHandler());

        $id = $request->request->get('id');
        $articleModel = new ArticleModel();

        if (isset($id)) {
            $articleModel->delete($id);
            $logger->info('Supression réussie');
        } else {
            $logger->error('Erreur lors de la suppression');
        }
        (new RedirectResponse("index.php"))->send();
    }
}
