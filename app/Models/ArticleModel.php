<?php

namespace App\Models;

use App\Models\Model;

class ArticleModel extends Model
{

    public function create($titre, $contenu, $img, $userID)
    {

        try {
            $requete = $this->pdo->prepare('INSERT INTO articles(`titre`, `contenu`, `user_id`, `img_url`) VALUES (:titre, :contenu, :userId, :img)');
            $requete->execute(array(
                'titre' => $titre,
                'contenu' => $contenu,
                'userId' => $userID,
                'img' => $img
            ));
            echo "Votre artcicle a bien été ajouté !";
        } catch (\Exception $e) {
            echo "échec de l'ajout", $e->getMessage();
        }
    }

    public function delete($id)
    {

        $req_del = "DELETE FROM articles WHERE id=$id";
        $this->pdo->exec($req_del);
    }

    public function update($id, $titre, $contenu, $img)
    {
        $req_up = $this->pdo->prepare("UPDATE articles SET titre= :titre,contenu= :contenu,img_url= :img WHERE id=$id");
        $req_up->execute(array(
            'titre' => $titre,
            'contenu' => $contenu,
            'img' => $img
        ));
    }

    public function getArticleById($id)
    {
        $query = $this->pdo->query("SELECT * FROM articles WHERE id=$id");
        $article = $query->fetch(\PDO::FETCH_OBJ);
        return $article;
    }

    public function getAllArticle()
    {
        $query = $this->pdo->query("SELECT * FROM articles");
        $articles = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $articles;
    }

    public function showAriclesByUser($userId)
    {
        $query = $this->pdo->query("SELECT titre, id FROM articles WHERE user_id=$userId");
        $articles = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $articles;
    }
}
