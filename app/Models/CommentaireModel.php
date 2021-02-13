<?php

namespace App\Models;

use App\Models\Model;

class CommentaireModel extends Model
{
    public function create(string $content, int $articleId, int $userId): void
    {
        $request = $this->pdo->prepare("INSERT INTO commentaires (content, articleId, usersId) VALUES (:content, :articleId, :userId)");
        $request->execute(array(
            'content' => $content,
            'articleId' => $articleId,
            'userId' => $userId
        ));
    }

    public function getCommentsByArticle($articleId)
    {
        $query = $this->pdo->query("SELECT * FROM users  INNER JOIN commentaires ON users.id = commentaires.usersId WHERE articleId=$articleId");
        $commentaires = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $commentaires;
    }

    public function getAllComments()
    {
        $query = $this->pdo->query("SELECT * FROM commentaires  INNER JOIN users ON commentaires.usersId = users.id INNER JOIN articles ON commentaires.articleId = articles.id");
        $comments = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $comments;
    }
}
