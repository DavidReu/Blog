<?php

namespace App\Models;

class PdoModel
{
    private $dbName;
    private $server;
    private $user;
    private $pass;

    public function __construct($dbName = 'db', $serverName = 'db', $userName = 'db', $password = 'db')
    {
        $this->dbName = $dbName;
        $this->server = $serverName;
        $this->user = $userName;
        $this->pass = $password;
    }

    public function Connexion()
    {
        try {
            echo 'Connexion réussie';
        } catch (\PDOException $e) {
            echo "Echec de la connexion" . $e->getMessage();
        };
    }

    public function getPDO()
    {
        try {
            $pdo = new \PDO('mysql:host=' . $this->server . ';dbname=' . $this->dbName . ';charset=utf8', $this->user, $this->pass);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
