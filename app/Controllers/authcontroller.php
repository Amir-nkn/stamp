<?php

namespace App\Controllers;

use App\Models\User;
use App\Providers\View;
use App\Providers\Validator;
use PDO;

class AuthController{

    // Affiche la page de connexion
    public function index()
    {
        return View::render('auth/index');
    }

    // Traite la soumission du formulaire de connexion
    public function store($data=[]){

        $validator = new Validator;

        // Valide le champ 'username' : requis, max 50 caractères, et format email
        $validator->field('username', $data['username'])->required()->max(50)->email();

        // Valide le champ 'password' : min 6 caractères, max 20 caractères
        $validator->field('password', $data['password'])->min(6)->max(20);

        // Si la validation est réussie
        if($validator->isSuccess()){

            $user = new User;

            // Vérifie si l'utilisateur existe avec les identifiants donnés
            $check = $user->checkUser($data['username'],$data['password']);

            if($check){
                // L'utilisateur est authentifié, on affiche la page d'accueil avec la session
                $_SESSION['user_name'] = $data['username']; 
                header('Location: ' . BASE); 
                exit;

            }else{
                // Les identifiants sont incorrects
                $errors['credential'] = "Please check your credentials!";
                return View::render('auth/index', ['errors'=>$errors, 'user'=>$data]);
            }

        }else{
            // Récupère les erreurs de validation et réaffiche le formulaire avec les erreurs
            $errors = $validator->getErrors();
            return View::render('auth/index', ['errors'=>$errors, 'user'=>$data]);
        }
    }

    // Déconnecte l'utilisateur et enregistre les informations de visite
    public function delete()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $usernameLog = $_SESSION['user_name'] ?? '������'; // Valeur par défaut si non défini
        $page = '���� �� �����'; // Nom de la page visitée

        // Connexion à la BASE de données
        $db = new \PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=' . DB_PORT . ';charset=utf8', DB_USER, DB_PASS);

        // Prépare et exécute l'insertion dans la table des logs
        $sql = "INSERT INTO logs (ip_address, username, page_visited) 
            VALUES (:ip, :username, :page)";

        $db->prepare($sql)->execute([
            ':ip' => $ip,
            ':username' => $usernameLog,
            ':page' => $page
        ]);

        // Détruit la session de l'utilisateur
        session_destroy();

        // Redirige vers la page de connexion
        header('Location: ' . BASE);

    }

    // Affiche les journaux des visites
    public function showLogs()
    {
        // Connexion à la BASE de données
        $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=' . DB_PORT . ';charset=utf8', DB_USER, DB_PASS);

        // Récupère tous les logs triés par date de visite (descendant)
        $sql = "SELECT * FROM logs ORDER BY visit_time DESC";
        $stmt = $db->query($sql);

        $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Affiche la vue avec les données de logs
        return View::render('logs', ['logs' => $logs]);
    }
}
