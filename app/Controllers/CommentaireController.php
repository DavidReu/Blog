<?php

namespace App\Controllers;

use App\Models\CommentaireModel;
use Symfony\Component\HttpFoundation\Request;
use App\Controllers\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CommentaireController extends Controller
{

    public function createCom(Request $request)
    {

        $session = new Session();
        $userId = $session->get('userId');
        $articleId = $request->request->get('id');
        $userId = intval($userId);
        $articleId = intval($articleId);
        //dd($request);
        //dd($userId);
        $commentaireModel = new CommentaireModel();
        $poster = $request->request->get('poster');
        if (isset($poster)) {
            $content = $request->request->get('content');
            $content = $this->valid($content);
            $commentaireModel->create($content, $articleId, $userId);
        }
        (new RedirectResponse("index.php"))->send();
    }

    public function showAllComments()
    {
        $commentaireModel = new CommentaireModel();
        $comments = $commentaireModel->getAllComments();
        //dd($comments);
        $this->render('commentaires/listComment', ['comments' => $comments]);
    }
}
