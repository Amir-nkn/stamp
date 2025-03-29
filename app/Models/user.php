<?php

namespace App\Models;
use App\Models\CRUD;

// Classe User qui hérite de la classe CRUD pour les opérations sur la table 'user'
class User extends CRUD {

    // Nom de la table liée à ce modèle
    protected $table = 'user';

    // Clé primaire de la table
    protected $primaryKey = 'id';

    // Champs autorisés pour l’insertion/mise à jour
    protected $fillable = ['name', 'email', 'password', 'privilege_id'];

    // Fonction pour hasher un mot de passe avec BCRYPT
    final public function hashPassword($password, $cost = 10) {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => $cost]);
    }

    // Vérifie les identifiants de l'utilisateur (nom et mot de passe)
    public function checkUser($name, $password) {
        // Recherche l'utilisateur par son nom
        $user = $this->unique('name', $name);
        
        // Si l'utilisateur est trouvé et que le mot de passe est correct
        if ($user && password_verify($password, $user['password'])) {

            // Sécurise la session
            session_regenerate_id();

            // Enregistre les informations de l'utilisateur dans la session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['privilege_id'] = $user['privilege_id'];
            $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);

            // Enregistre l'action de connexion
            $this->logUserAction($user['name'], 'Login to system');
            return true;
        } 
        
        // Si les identifiants sont incorrects, enregistre l'échec
        $this->logUserAction($name, 'Error Login to system');
        return false;
    }

    // Enregistre une action de l'utilisateur dans la table 'logs'
    private function logUserAction($name, $action) {
        $ip = $_SERVER['REMOTE_ADDR'];
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
