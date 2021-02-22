<?php

namespace App\Controllers;

use App\Models\CommentaireModel;
use Symfony\Component\HttpFoundation\Request;
use App\Controllers\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Models\ArticleModel;


class CommentaireController extends Controller
{

    public function createCom(Request $request)
    {

        $session = new Session();
        $userId = $session->get('userId');
        $articleId = $request->request->get('id');
        $userId = intval($userId);
        $articleId = intval($articleId);
        $commentaireModel = new CommentaireModel();
        $poster = $request->request->get('poster');
        if (isset($poster)) {
            $content = $request->request->get('content');
            $content = $this->valid($content);
            $commentaireModel->create($content, $articleId, $userId);
        }
        (new RedirectResponse("index.php"))->send();
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
        $commentModel = new CommentaireModel();
        $edit = $request->request->get('editComment');
        if (isset($edit)) {
            $id = $request->request->get('commentId');
            $articleId = $request->request->get("articleId");
            $content = $request->request->get('newContent');
            $editComment = $commentModel->updateComment($id, $content);
        }
        (new RedirectResponse("/article?id=" . $articleId))->send();
    }
}
