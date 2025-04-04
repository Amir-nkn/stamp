<?php

namespace App\Controllers;

use App\Models\User;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

class UserController{

//    public function __construct(){
//        $publicRoutes = ['/stamp_auction/user/create', '/stamp_auction/user/store'];
//        $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//        if (!in_array($currentPath, $publicRoutes)) {
//            Auth::session();
//        }
//    }

    public function index() {
        $user = new user();
        $users = $user->select(); 

        return View::render('user/index', ['users' => $users]); 
    }

    public function show($data) {
        if (!isset($data['id']) || empty($data['id'])) {
            return View::render('error', ['msg' => 'Invalid user ID']);
        }

        $user = new user();
        $userData = $user->selectId($data['id']);
        
        if (!$userData) {
            return View::render('error', ['msg' => 'user not found']);
        }
        return View::render('user/show', ['user' => $userData]);
    }

    public function create(){
        return View::render('user/create');
    }

     public function edit($data) {
        if (!isset($data['id']) || empty($data['id'])) {
            return View::render('error', ['msg' => 'Invalid user ID']);
        }

        $user = new user();
        $userData = $user->selectId($data['id']); // Récupère les informations du produit.

        if (!$userData) {
            return View::render('error', ['msg' => 'user not found']); // Affiche une erreur si le produit n'existe pas.
        }

        $validator = new Validator();
        $validator->field('name', $data['name'] ?? $userData['name'])->required()->min(3)->max(50);
        $validator->field('email', $data['email'] ?? $userData['email'])->required()->min(7)->max(50);
        $validator->field('password', $data['password'] ?? $userData['password'])->min(6)->max(20);

        if (!$validator->isSuccess()) {
            return View::render('user/edit',['errors' => $validator->getErrors(),'user' => array_merge($userData, $data)]);
        }

        return View::render('user/edit', ['user' => $userData ]);
    }
 
    public function store($data=[]){

        $validator = new Validator;
        $validator->field('name', $data['name'])->min(3)->max(25);
        $validator->field('email', $data['email'])->unique('User')->required()->max(50);
        $validator->field('password', $data['password'])->min(6)->max(20);
        $validator->field('privilege_id', $data['privilege_id'], "privilege")->number()->required();
        
        if($validator->isSuccess()){
            $user = new User;
            $data['password'] = $user->hashPassword($data['password']);
            // print_r($data);
            // die();
            $insert = $user->insert($data);
            if($insert){
                return view::redirect('');
            }
        }else{
            $errors = $validator->getErrors();
            return View::render('user/create', ['errors'=>$errors, 'user'=>$data]);
        }
    }

    public function update($data) {
        if (!isset($data['id']) || empty($data['id'])) {
            return View::render('error', ['msg' => 'Invalid user ID']); // Vérification de l'ID.
        }

        $user = new user();
        $user->update($data, $data['id']); // Met à jour les informations du produit.

        header('Location: ' . BASE . '/user');
    }

    public function delete($data) {
        if (!isset($data['id']) || empty($data['id'])) {
            return View::render('error', ['msg' => 'Invalid user ID']); // Vérification de l'ID.
        }

        $user = new user();
        $user->delete($data['id']); // Supprime le produit.

        // Redirige vers la liste des produits après la suppression.
        header('Location: ' . BASE . '/user');
        exit;
    }

}