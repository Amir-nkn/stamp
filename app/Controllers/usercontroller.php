<?php

namespace App\Controllers;

use App\Models\User;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

class UserController{

    // Constructeur désactivé ici - permettrait de sécuriser les routes sauf celles spécifiées comme publiques
//    public function __construct(){
//        $publicRoutes = ['/stamp_auction/user/create', '/stamp_auction/user/store'];
//        $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//        if (!in_array($currentPath, $publicRoutes)) {
//            Auth::session();
//        }
//    }

    // Affiche la liste de tous les utilisateurs
    public function index() {
        $user = new user();
        $users = $user->select(); 
        return View::render('user/index', ['users' => $users]); 
    }

    // Affiche les détails d’un utilisateur spécifique
    public function show($data) {
        if (!isset($data['id']) || empty($data['id'])) {
            return View::render('error', ['msg' => 'Invalid user ID']); // Vérifie que l'ID est présent
        }

        $user = new user();
        $userData = $user->selectId($data['id']); // Récupère l'utilisateur par ID

        if (!$userData) {
            return View::render('error', ['msg' => 'user not found']); // Affiche une erreur si utilisateur non trouvé
        }
        return View::render('user/show', ['user' => $userData]);
    }

    // Affiche le formulaire de création d’un nouvel utilisateur
    public function create(){
        return View::render('user/create');
    }

    // Affiche le formulaire d'édition d’un utilisateur avec validation des champs
    public function edit($data) {
        if (!isset($data['id']) || empty($data['id'])) {
            return View::render('error', ['msg' => 'Invalid user ID']); // Vérifie l’ID de l'utilisateur
        }

        $user = new user();
        $userData = $user->selectId($data['id']); // Récupère les informations de l'utilisateur

        if (!$userData) {
            return View::render('error', ['msg' => 'user not found']); // Erreur si l'utilisateur n'existe pas
        }

        // Validation des champs avec des valeurs par défaut si non fournies
        $validator = new Validator();
        $validator->field('name', $data['name'] ?? $userData['name'])->required()->min(3)->max(50);
        $validator->field('email', $data['email'] ?? $userData['email'])->required()->min(7)->max(50);
        $validator->field('password', $data['password'] ?? $userData['password'])->min(6)->max(20);

        // Si validation échoue, affiche le formulaire avec les erreurs
        if (!$validator->isSuccess()) {
            return View::render('user/edit',['errors' => $validator->getErrors(),'user' => array_merge($userData, $data)]);
        }

        // Si tout est valide, affiche la vue d'édition avec les données existantes
        return View::render('user/edit', ['user' => $userData ]);
    }

    // Enregistre un nouvel utilisateur dans la base de données
    public function store($data=[]){

        $validator = new Validator;

        // Validation des champs
        $validator->field('name', $data['name'])->min(3)->max(25);
        $validator->field('email', $data['email'])->unique('User')->required()->max(50);
        $validator->field('password', $data['password'])->min(6)->max(20);
        $validator->field('privilege_id', $data['privilege_id'], "privilege")->number()->required();
        
        if($validator->isSuccess()){
            $user = new User;

            // Hash le mot de passe avant insertion
            $data['password'] = $user->hashPassword($data['password']);

            // Insère l'utilisateur en base de données
            $insert = $user->insert($data);

            if($insert){
                return view::redirect('');
            }

        }else{
            // Si la validation échoue, retourne au formulaire avec erreurs
            $errors = $validator->getErrors();
            return View::render('user/create', ['errors'=>$errors, 'user'=>$data]);
        }
    }

    // Met à jour les informations d’un utilisateur existant
    public function update($data) {
        if (!isset($data['id']) || empty($data['id'])) {
            return View::render('error', ['msg' => 'Invalid user ID']); // Vérifie que l’ID est fourni
        }

        $user = new user();
        $user->update($data, $data['id']); // Effectue la mise à jour

        // Redirige vers la liste des utilisateurs
        header('Location: ' . BASE . '/user');
    }

    // Supprime un utilisateur existant
    public function delete($data) {
        if (!isset($data['id']) || empty($data['id'])) {
            return View::render('error', ['msg' => 'Invalid user ID']); // Vérifie que l’ID est fourni
        }

        $user = new user();
        $user->delete($data['id']); // Supprime l'utilisateur

        // Redirige vers la liste des utilisateurs
        header('Location: ' . BASE . '/user');
        exit;
    }

}
