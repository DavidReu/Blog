<?php

namespace App\Models;


class ArticleModel
{
    public $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }


    public function create($titre, $contenu, $img)
    {

        try {
            $requete = $this->pdo->prepare('INSERT INTO `blogs`(`titre`, `contenu`, `user_id`, `img_url`) VALUES (:titre, :contenu, :userId, :img)');
            $requete->execute(array(
                'titre' => $titre,
                'contenu' => $contenu,
                'userId' => "1",
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
        $req_up = $this->pdo->prepare("UPDATE `articles` SET`titre`= :titre,`contenu`= :contenu,`img_url`= :img WHERE id=$id");
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
}
