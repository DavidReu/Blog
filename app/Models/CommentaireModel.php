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

    public function showCommentsByArticle($articleId)
    {
        $query = $this->pdo->query("SELECT * FROM users  INNER JOIN commentaires ON users.id = commentaires.usersId WHERE articleId=$articleId");
        $commentaires = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $commentaires;
    }

    public function showCommentsByUser($userId)
    {
        $query = $this->pdo->query("SELECT content FROM commentaires WHERE usersId=$userId");
        $comments = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $comments;
    }

    public function getAllComments(): array
    {
        $query = $this->pdo->query("SELECT a.titre, u.prenom, u.nom, c.content, c.id, a.id AS articleid, u.id AS userid  FROM commentaires AS c  INNER JOIN users AS u ON c.usersId = u.id INNER JOIN articles AS a ON c.articleId = a.id");
        $comments = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $comments;
    }

    public function getAllCommentsByArticle($id): ?array
    {
        if (is_numeric($id)) {
            $queryArticles = $this->pdo->query("SELECT id FROM articles WHERE id=$id");
            $artticles = $queryArticles->fetch(\PDO::FETCH_ASSOC);
            $query = $this->pdo->query("SELECT a.titre, u.prenom, u.nom, c.content, c.id, a.id AS articleid, u.id AS userid  FROM commentaires AS c  INNER JOIN users AS u ON c.usersId = u.id INNER JOIN articles AS a ON c.articleId = a.id WHERE articleid=$id");
            $comments = $query->fetchAll(\PDO::FETCH_ASSOC);
            return $comments;
        }
        return null;
    }

    public function getComments()
    {
        $query = $this->pdo->query("SELECT * FROM commentaires");
        $comments = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $comments;
    }

    public function deleteComment($id)
    {
        $req_delete = "DELETE FROM commentaires WHERE id=$id";
        $this->pdo->exec($req_delete);
    }
}
