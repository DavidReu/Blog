<?php

namespace App\Models;


class ArticleModel
{
    public $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    /*
    public function afficherTitre()
    {
        echo $this->titre;
    }

    public function afficherContenu()
    {
        echo $this->contenu;
    }

    public function afficherImg()
    {
        echo $this->img;
    }

    public function afficherId()
    {
        echo $this->id;
    } */

    public function create($titre, $contenu, $img)
    {
        /* $this->titre = $titre;
        $this->contenu = $contenu;
        $this->img = $img; */

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

        $req_del = "DELETE FROM blogs WHERE id=$id";
        $this->pdo->exec($req_del);
        echo "L'article numéro " . $id . " a été supprimé";
    }

    public function update($id, $titre, $contenu, $img)
    {
        $req_up = $this->pdo->prepare("UPDATE `blogs` SET`titre`= :titre,`contenu`= :contenu,`img_url`= :img WHERE id=$id");
        $req_up->execute(array(
            'titre' => $titre,
            'contenu' => $contenu,
            'img' => $img
        ));
    }

    public function getArticleById($id)
    {
        $query = $this->pdo->query("SELECT * FROM blogs WHERE id=$id");
        $article = $query->fetch(\PDO::FETCH_OBJ);
        return $article;
    }

    public function getAllArticle()
    {
        $query = $this->pdo->query("SELECT * FROM blogs");
        $articles = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $articles;
    }
}
