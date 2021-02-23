<?php

namespace App\Models;

use App\Models\Model;
use Symfony\Component\VarDumper\VarDumper;

class UserModel extends Model
{

    public function register($mail, $mdp, $nom, $prenom, $role)
    {
        try {
            $requete = $this->pdo->prepare('INSERT INTO `users`(`mail`, `mdp`, `nom`, `prenom`) VALUES (:mail, :mdp, :nom, :prenom)');
            $requete->execute(array(
                'mail' => $mail,
                'mdp' => $mdp,
                'nom' => $nom,
                'prenom' => $prenom
            ));
            $user_id = $this->pdo->lastInsertId();
            $requete2 = $this->pdo->prepare('INSERT INTO `role` (`role`, `user_id`) VALUES (:role, :user_id)');
            $requete2->execute(array(
                'role' => $role,
                'user_id' => $user_id
            ));
        } catch (\Exception $e) {
            echo "échec de l'enregistrement", $e->getMessage();
        }
    }

    public function registerEditor($mail, $mdp, $nom, $prenom, $role)
    {
        try {
            $requete = $this->pdo->prepare('INSERT INTO `users`(`mail`, `mdp`, `nom`, `prenom`) VALUES (:mail, :mdp, :nom, :prenom)');
            $requete->execute(array(
                'mail' => $mail,
                'mdp' => $mdp,
                'nom' => $nom,
                'prenom' => $prenom
            ));
            $user_id = $this->pdo->lastInsertId();
            $requete2 = $this->pdo->prepare('INSERT INTO `role` (`role`, `user_id`) VALUES (:role, :user_id)');
            $requete2->execute(array(
                'role' => $role,
                'user_id' => $user_id
            ));
        } catch (\Exception $e) {
            echo "échec de l'enregistrement", $e->getMessage();
        }
    }

    /* public function log($mail)
    {
        $query = $this->pdo->query("SELECT * FROM `users` WHERE mail = '$mail' ");
        $user = $query->fetch(\PDO::FETCH_OBJ);
        return $user;
    } */

    //fonction pour se connecté en récupérant le role
    public function log($mail)
    {
        $query = $this->pdo->query("SELECT * FROM `users` INNER JOIN `role` ON users.id = role.user_id WHERE mail = '$mail' ");
        $user = $query->fetch(\PDO::FETCH_OBJ);
        return $user;
    }

    public function getUsers(): array
    {
        $query = $this->pdo->query("SELECT * FROM `users`");
        $users = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $users;
    }

    public function getUser($id)
    {
        $query = $this->pdo->query("SELECT * FROM users WHERE id=$id");
        $user = $query->fetch(\PDO::FETCH_OBJ);
        return $user;
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

    public function updateProfil($id, $nom, $prenom, $mail, $mdp)
    {
        $req_up = $this->pdo->prepare("UPDATE users sET nom= :nom, prenom= :prenom, mail= :mail, mdp= :mdp WHERE id=$id");
        $req_up->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'mail' => $mail,
            'mdp' => $mdp
        ]);
    }

    public function deleteUser($id)
    {
        $req_delete = "DELETE FROM users WHERE id=$id";
        $this->pdo->exec($req_delete);
    }
}
