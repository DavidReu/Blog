<?php

namespace App\Controllers;

use App\Models\CommentaireModel;
use Symfony\Component\HttpFoundation\Request;
use App\Controllers\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Models\ArticleModel;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;


class CommentaireController extends Controller
{

    public function createCom(Request $request)
    {
        $logger = new Logger("create_comment");
        $logger->pushHandler(new StreamHandler('php://stderr', Logger::DEBUG));
        $logger->pushHandler(new FirePHPHandler());

        $session = new Session();
        $userId = $session->get('userId');
        $articleId = $request->request->get('id');
        $userId = intval($userId);
        $articleId = intval($articleId);
        $commentaireModel = new CommentaireModel();
        $poster = $request->request->get('poster');
        $content = $request->request->get('content');
        if (isset($poster) && !empty($content) && preg_match('/[a-zA-Zéèàêùûüîïôöàâä]+/', $content)) {
            $content = $this->valid($content);
            $logger->info('Commentaire bien créé');
            $commentaireModel->create($content, $articleId, $userId);
        } else {
            $logger->error('Erreur lors de la création d\'un commentaire');
        }
        (new RedirectResponse("/article?id=" . $articleId))->send();
    }

    public function showAllComments(Request $request)
    {
        $articleModel = new ArticleModel();
        $articles = $articleModel->getAllArticle();
        $commentaireModel = new CommentaireModel();
        $comments = $commentaireModel->getAllComments();
        $articleId = $request->get('article');
        if (isset($articleId)) {
            $comments = $commentaireModel->getAllCommentsByArticle($articleId);
            if ($comments == null) {
                $comments = $commentaireModel->getAllComments();
            }
        }
        $this->render('commentaires/listComment', ['comments' => $comments, 'articles' => $articles]);
    }

    public function getComments(Request $request)
    {
        if ($request->getMethod() == "GET") {
            $commentModel = new CommentaireModel();
            $comments = $commentModel->getComments();
            $jsonResponse = new JsonResponse($comments);
            $jsonResponse->send();
        }
        if ($request->getMethod() == "DELETE") {
            $commentModel = new CommentaireModel();
            $id = $request->query->get('id');
            $delete = $commentModel->deleteComment($id);
            $jsonResponse = new JsonResponse(['success' => 'Tout c\'est bien passé'], 200);
            json_encode($jsonResponse);
            $jsonResponse->send();
        }
    }

    public function updateComment(Request $request)
    {
        $logger = new Logger("update_comment");
        $logger->pushHandler(new StreamHandler('php://stderr', Logger::DEBUG));
        $logger->pushHandler(new FirePHPHandler());

        $commentModel = new CommentaireModel();
        $edit = $request->request->get('editComment');
        $content = $request->request->get('newContent');
        if (isset($edit) && !empty($content)) {
            $id = $request->request->get('commentId');
            $articleId = $request->request->get("articleId");
            $content = $this->valid($content);
            $logger->info('Commentaire bien modifié');
            $editComment = $commentModel->updateComment($id, $content);
        } else {
            $logger->error('Echec de la moficiation');
        }
        (new RedirectResponse("/article?id=" . $articleId))->send();
    }
}
