<?php

namespace App\Controllers;

//use PDO;

class PdoController
{
    private $dbName;
    private $server;
    private $user;
    private $pass;

    public function __construct($dbName = 'blog', $serverName = 'localhost', $userName = 'root', $password = 'root')
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
        //return [$this->getDbName(), $this->getUser(), $this->getPass()];
        try {
            //throw new Error("une erreur est survenue");
            $pdo = new \PDO('mysql:host=' . $this->server . ';dbname=' . $this->dbName . ';charset=utf8', $this->user, $this->pass);
            //$pdo = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
   //return parent::__construct("mysql:host=" . $serverName . ";dbname=" . $dbName, $userName, $password);
