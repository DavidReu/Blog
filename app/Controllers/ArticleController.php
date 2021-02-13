<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use App\Controllers\Controller;
//use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Controllers\CommentaireController;
use App\Models\CommentaireModel;

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
        $id = $request->get('id');
        $articleModel = new ArticleModel();
        $commentaireModel = new CommentaireModel();
        $article = $articleModel->getArticleById($id);
        $commentaires = $commentaireModel->getCommentsByArticle($id);
        $results = ['article' => $article, 'commentaires' => $commentaires];
        $this->render('single', $results);
    }

    public function createForm(Request $request)
    {
        $articleModel = new ArticleModel();
        $uri = $request->getPathInfo();
        $poster = $request->get('poster');

        if (isset($poster)) {
            $titre = $request->request->get('titre');
            $contenu = $request->request->get('contenu');
            $titre = $this->valid($titre);
            $contenu = $this->valid($contenu);
            $img = $_FILES['img']['name'];
            $dossier = 'upload/';
            if (!empty($_FILES["img"]["tmp_name"]))
                move_uploaded_file($_FILES["img"]["tmp_name"], $dossier . $img);
            $fichier = '/upload' . '/' . $img;
            $articleModel->create($titre, $contenu, $fichier);
        }
        $this->render('formcreate', ['article' => '']);
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
