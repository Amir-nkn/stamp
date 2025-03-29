<?php

namespace App\Controllers;

use App\Models\ExampleModel;
use App\Providers\View;

class HomeController{

    // Affiche la page d'accueil
    public function index(){
        // $model = new ExampleModel;
        // Exemple d'utilisation du modèle pour récupérer des données
        // $data = "Peter";
        // $data = $model->getData();
        // include('views/home.php');

        return View::render('home'); // Rend la vue 'home'
    }

    // Méthode simple pour afficher un message sur la page "à propos"
    public function about(){
        echo "Hello about";
    }
}
