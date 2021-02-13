<?php

namespace App\Models;

use App\Models\Model;


class UserModel extends Model
{

    public function register($mail, $mdp, $nom, $prenom)
    {
        try {
            $requete = $this->pdo->prepare('INSERT INTO `users`(`mail`, `mdp`, `nom`, `prenom`) VALUES (:mail, :mdp, :nom, :prenom)');
            $requete->execute(array(
                'mail' => $mail,
                'mdp' => $mdp,
                'nom' => $nom,
                'prenom' => $prenom
            ));
            echo "Votre inscription est un succès !";
        } catch (\Exception $e) {
            echo "échec de l'enregistrement", $e->getMessage();
        }
    }

    public function log($mail)
    {
        $query = $this->pdo->query("SELECT * FROM `users` WHERE `mail` = '$mail' ");
        $user = $query->fetch(\PDO::FETCH_OBJ);
        return $user;
    }

    public function getUsers(): array
    {
        $query = $this->pdo->query("SELECT * FROM `users`");
        $users = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $users;
    }

    public function updateUser($id, $nom, $prenom, $mail)
    {
        $req_up = $this->pdo->prepare("UPDATE users SET nom= :nom, prenom= :prenom, mail= :mail WHERE id=$id");
        $req_up->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'mail' => $mail
        ]);
    }

    public function deleteUser($id)
    {
        $req_delete = "DELETE FROM users WHERE id=$id";
        $this->pdo->exec($req_delete);
    }

    /* public function update($id, $mdp)
    {
        $mdp = password_hash($mdp, PASSWORD_BCRYPT);
        $req_up = $this->pdo->prepare("UPDATE `users` SET`mdp`= :mdp WHERE id='$id'");
        $req_up->execute(array(
            'mdp' => $mdp
        ));
    } */
}
