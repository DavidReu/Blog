<?php

namespace App\Models;

use App\Models\PdoModel;

class Model
{
    protected $pdo;

    public function __construct()
    {
        $pdoModel = new PdoModel();
        $pdo = $pdoModel->getPDO();
        $this->pdo = $pdo;
    }
}
