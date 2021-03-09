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
        $logger->pushHandler(new StreamHandler('php://stderr', Logger::DEBUG));
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

    /* public function showForm()
    {
        $this->render('formcreate');
    } */

    public function createForm(Request $request)
    {
        $articleModel = new ArticleModel();
        $uri = $request->getPathInfo();
        $poster = $request->get('poster');
        $longeur = strlen($request->request->get('titre'));
        $session = new Session();

        $logger = new Logger("create_article");
        $logger->pushHandler(new StreamHandler('php://stderr', Logger::DEBUG));
        $logger->pushHandler(new FirePHPHandler());
        echo 'BONJOUR';
        $this->render('formcreate');
        include('../../Views/article/formCreate.php');

        if (isset($poster)) {
            $titre = $request->request->get('titre');
            $contenu = $request->request->get('contenu');
            $img = $request->request->get('img');
            if (!empty($titre) || !empty($contenu)) {
                $titre = $this->valid($titre);
                $contenu = $this->valid($contenu);
                $img = $this->valid($img);
                $img = $_FILES['img']['name'];
                $dossier = 'upload/';
                $userId = $session->get('userId');
                $logger->info('Tout va bien');
                if (!empty($_FILES["img"]["tmp_name"])) {
                    move_uploaded_file($_FILES["img"]["tmp_name"], $dossier . $img);
                    $fichier = '/upload' . '/' . $img;
                } else {
                    $logger->error('Aucune images envoyées');
                    $this->render('formcreate');
                }
                $articleModel->create($titre, $contenu, $fichier, $userId);
                (new RedirectResponse("/index.php"))->send();
            }
        } else {
            $logger->error('Aucune données envoyées');
            $this->render('formcreate');
        }
        $this->render('formUpdate');
    }

    public function formUpdate(Request $request)
    {
        $logger = new Logger("update_article");
        $logger->pushHandler(new StreamHandler('php://stderr', Logger::DEBUG));
        $logger->pushHandler(new FirePHPHandler());

        $articleModel = new ArticleModel();
        $id = $request->get('id');
        $article = $articleModel->getArticleById($id);
        $modifier = $request->get('modifier');

        if (isset($modifier)) {
            $titre = $request->request->get('titre');
            $contenu = $request->request->get('contenu');
            $img = $request->request->get('img');
            $titre = $this->valid($titre);
            $contenu = $this->valid($contenu);
            $img = $this->valid($img);

            if (!empty($_FILES["img"]["tmp_name"])) {
                $img = $_FILES['img']['name'];
                $dossier = 'upload/';
                move_uploaded_file($_FILES["img"]["tmp_name"], $dossier . $img);
                $fichier = '/upload' . '/' . $img;
            }
            $articleModel->update($id, $titre, $contenu, $fichier);
            $logger->info('Modification effectuée');
            $article = $articleModel->getArticleById($id);
        } else {
            $logger->error('Echec de la moficiation');
        }
        $this->render('formUpdate', ['article' => $article]);
    }

    public function delete(Request $request)
    {
        $logger = new Logger("delete_article");
        $logger->pushHandler(new StreamHandler('php://stderr', Logger::DEBUG));
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
