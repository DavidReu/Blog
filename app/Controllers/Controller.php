<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Response;

class Controller
{
    public function render($path, $tab = [])
    {
        // Récupère les données et les extrait sous forme de variables
        extract($tab);


        // Crée le chemin et inclut le fichier de vue
        ob_start();
        include('Views/article/' . $path . '.php');
        //$response->setContent(json_encode(["data" => "bouh"]));
        /**
         * Tout ce qui se trouve après ob_start sera enregistrer dans la variable $content grâce à ob_get_clean 
         * et la variable $content est utilisé dans le template
         */


        $response = new Response(ob_get_clean());
        include('Views/template.php');
        $response->send();
    }

    public function valid($donnees)
    {
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlentities($donnees);
        return $donnees;
    }
}
