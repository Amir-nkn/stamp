<?php

namespace App\Models;
use App\Models\CRUD;

// La classe User hérite des méthodes CRUD pour interagir avec la base de données
class User extends CRUD {
    // Nom de la table associée
    protected $table = 'user';

    // Clé primaire
    protected $primaryKey = 'id';

    // Champs pouvant être remplis lors des insertions/mises à jour
    protected $fillable = ['name', 'email', 'password', 'privilege_id'];

    // Hachage du mot de passe avec l'algorithme BCRYPT
    final public function hashPassword($password, $cost = 10) {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => $cost]);
    }

    // Vérifie si l'utilisateur existe et si le mot de passe est correct
    public function checkUser($name, $password) {
        $user = $this->unique('name', $name); // Recherche de l'utilisateur par nom

        // Vérification du mot de passe et configuration de la session
        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(); // Pour éviter le vol de session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['privilege_id'] = $user['privilege_id'];
            $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);

            $this->logUserAction($user['name'], 'Login to system'); // Journalisation de la connexion
            return true;
        } 
        
        // Si l'authentification échoue, on journalise aussi l'échec
        $this->logUserAction($name, 'Error Login to system');
        return false;
    }

    // Enregistre une action de l'utilisateur dans la table "logs"
    private function logUserAction($name, $action) {
        $ip = $_SERVER['REMOTE_ADDR']; // Adresse IP de l'utilisateur
        $sql = "INSERT INTO logs (ip_address, username, page_visited) VALUES (:ip, :name, :page)";
        $stmt = $this->prepare($sql);

        if ($stmt) {
            $stmt->execute([
                ':ip'   => $ip,
                ':name' => $name,
                ':page' => $action
            ]);
        }
    }
}
