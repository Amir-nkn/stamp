<?php
namespace App\Providers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

// Classe statique pour gérer le rendu des vues avec Twig
class View {

    // Rend une vue avec les données fournies
    static public function render($template, $data = []){

        // Initialise le chargeur Twig en pointant vers le dossier 'views'
        $loader = new FilesystemLoader('views');

        // Crée l’environnement Twig
        $twig = new Environment($loader);

        // Ajoute des variables globales disponibles dans toutes les vues
        $twig->addGlobal('ASSET', ASSET);            // Fonction asset pour les chemins vers les fichiers
        $twig->addGlobal('BASE', BASE);              // Chemin de BASE du projet
        $twig->addGlobal('session', $_SESSION);      // Session complète accessible dans les templates

        // Détermine si l'utilisateur est invité (non connecté)
        if(isset($_SESSION['fingerPrint']) && $_SESSION['fingerPrint'] == md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR'])){
            $guest = false;
        }else{
            $guest = true;
        }

        // Ajoute une variable globale 'guest' (booléen) aux vues
        $twig->addGlobal('guest', $guest);

        // Affiche le template Twig avec les données passées
        echo $twig->render($template.".php", $data);
    }

    // Redirige l'utilisateur vers une autre page
    static public function redirect($url){
        return header('location:'.BASE.'/'.$url);
    }
}
