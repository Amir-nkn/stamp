<?php

namespace App\Routes;

use App\Controllers\stamp;
use App\Controllers\CategoryController;
use App\Controllers\privilegeController;
use App\Controllers\AuthController;
/**
 * Classe Route permettant de gأ©rer le routage des requأھtes HTTP.
 */
class Route {
    
    /**
     * Tableau contenant la liste des routes enregistrأ©es.
     */
    private static $routes = [];

    /**
     * Enregistre une nouvelle route de type GET.
     * 
     * @param string $url L'URL associأ©e أ  la route.
     * @param string $controller Nom du contrأ´leur et de la mأ©thode (format "Controller@method").
     */
    public static function get($url, $controller) {
        self::$routes[] = ['url' => $url, 'controller' => $controller, 'method' => 'GET'];
    }

    /**
     * Enregistre une nouvelle route de type POST.
     * 
     * @param string $url L'URL associأ©e أ  la route.
     * @param string $controller Nom du contrأ´leur et de la mأ©thode (format "Controller@method").
     */
    public static function post($url, $controller) {
        self::$routes[] = ['url' => $url, 'controller' => $controller, 'method' => 'POST'];
    }

    /**
     * Gأ¨re la requأھte actuelle et exأ©cute le contrأ´leur correspondant.
     */
public static function dispatch() {
    // Récupère l'URL demandée par l'utilisateur.
    $url = $_SERVER['REQUEST_URI'];
    $urlSegments = explode('?', $url); // Sépare l'URL des paramètres de requête.
    $urlPath = $urlSegments[0]; // Extrait uniquement le chemin sans paramètres.
    $method = $_SERVER['REQUEST_METHOD']; // Récupère la méthode HTTP utilisée (GET ou POST).

    // Parcourt toutes les routes enregistrées pour trouver une correspondance.
    $pageFound = false; // Flag pour vérifier si la page a été trouvée
    foreach (self::$routes as $route) {
        if (BASE . $route['url'] == $urlPath && $route['method'] == $method) {
            // Sépare le contrôleur et la méthode (ex: "stamp@index").
            $controllerSegments = explode('@', $route['controller']);
            $controllerName = 'App\\Controllers\\' . $controllerSegments[0]; // Nom du contrôleur.
            $methodName = $controllerSegments[1]; // Nom de la méthode.
            
            // Instancie dynamiquement le contrôleur.
            $controllerInstance = new $controllerName();

            // Vérifie si la méthode est GET et traite les paramètres.
            if ($method == 'GET') {
                if (isset($urlSegments[1])) {
                    parse_str($urlSegments[1], $queryParams); // Convertit les paramètres GET en tableau associatif.
                    $controllerInstance->$methodName($queryParams); // Exécute la méthode du contrôleur avec les paramètres.
                } else {
                    $controllerInstance->$methodName(); // Exécute la méthode sans paramètres.
                }

            // Vérifie si la méthode est POST et traite les données.
            } elseif ($method == 'POST') {
                if (isset($urlSegments[1])) {
                    parse_str($urlSegments[1], $queryParams); // Convertit les paramètres GET en tableau associatif.
                    $controllerInstance->$methodName($_POST, $queryParams); // Exécute la méthode avec POST et paramètres GET.
                } else {
                    $controllerInstance->$methodName($_POST); // Exécute la méthode avec les données POST uniquement.
                }
            }
            $pageFound = true; // Page found
            break; // Stop iteration as we found the matching route
        }
    }

    // Si aucune route correspondante n'a été trouvée, retourne une erreur 404 avec le nom de la page.
    if (!$pageFound) {
        echo "Page not found: $urlPath\n"; // Affiche le nom de la page avant l'erreur 404
        http_response_code(404);
        exit; // Arrête l'exécution
    }
}}
