<?php

namespace App\Controllers;

use App\Models\Stamp;
use App\Providers\View;
use App\Providers\Validator;

class StampController {

    // Affiche la liste paginée des timbres
    public function index() {
        $perPage = 12; // Nombre d'éléments par page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Page actuelle
        $offset = ($page - 1) * $perPage; // Décalage pour la pagination

        $stamps = new Stamp();
        $stampsList = $stamps->getPaginatedStamps($perPage, $offset); // Récupère les timbres paginés
        $totalStamps = $stamps->countStamps(); // Nombre total de timbres
        $totalPages = ceil($totalStamps / $perPage); // Nombre total de pages

        return View::render('home', [
            'stamps' => $stampsList, // Liste des timbres à afficher
            'current_Page' => $page, // Page actuelle
            'total_Pages' => $totalPages // Nombre total de pages
        ]);
    }

    // Affiche le formulaire de création d’un timbre
    public function create() {
        return View::render('stamp/create');
    }

    // Traite la soumission du formulaire de création
    public function store($data) {
        $validator = new Validator();

        // Validation des champs du formulaire
        $validator->field('name', $data['name'])->required()->min(3)->max(50);
        $validator->field('description', $data['description'])->required()->min(10);
        $validator->field('price', $data['price'])->required()->positiveNumber()->minValue(1);
        $validator->field('quantity', $data['quantity'])->required()->positiveNumber()->minValue(1);

        // Si la validation échoue, on réaffiche le formulaire avec les erreurs
        if (!$validator->isSuccess()) {
            return View::render('stamp/create', [
                'errors' => $validator->getErrors(),
                'stamp' => $data,
            ]);
        }

        // Si validation réussie, on crée le timbre
        $stamp = new Stamp();
        $stamp->createStamp($data);

        // Redirection vers la liste des timbres
        header('Location: ' . BASE . '/stamp');
        exit;
    }

    // Affiche les détails d’un timbre
    public function show($data) {
        if (!isset($data['id']) || empty($data['id'])) {
            return View::render('error', ['msg' => 'Invalid stamp ID']); // ID manquant ou invalide
        }

        $stamp = new Stamp();
        $stampData = $stamp->getStampById($data['id']); // Récupère le timbre par son ID

        if (!$stampData) {
            return View::render('error', ['msg' => 'Stamp not found']); // Timbre introuvable
        }

        return View::render('stamp/show', ['stamp' => $stampData]);
    }

    // Affiche le formulaire d’édition d’un timbre
    public function edit($data) {
        if (!isset($data['id']) || empty($data['id'])) {
            return View::render('error', ['msg' => 'Invalid stamp ID']); // ID manquant ou invalide
        }

        $stamp = new Stamp();
        $stampData = $stamp->getStampById($data['id']); // Récupère les données du timbre

        if (!$stampData) {
            return View::render('error', ['msg' => 'Stamp not found']); // Timbre introuvable
        }

        return View::render('stamp/edit', [
            'stamp' => $stampData,
        ]);
    }

    // Met à jour les informations d’un timbre
    public function update($data) {
        if (!isset($data['id']) || empty($data['id'])) {
            return View::render('error', ['msg' => 'Invalid stamp ID']); // ID manquant ou invalide
        }

        $validator = new Validator();

        // Validation des champs du formulaire
        $validator->field('name', $data['name'])->required()->min(3)->max(50);
        $validator->field('description', $data['description'])->required()->min(10);
        $validator->field('price', $data['price'])->required()->positiveNumber()->minValue(1);
        $validator->field('quantity', $data['quantity'])->required()->positiveNumber()->minValue(1);

        // Si la validation échoue, on réaffiche le formulaire avec les erreurs
        if (!$validator->isSuccess()) {
            return View::render('stamp/edit', [
                'errors' => $validator->getErrors(),
                'stamp' => $data,
            ]);
        }

        // Mise à jour du timbre
        $stamp = new Stamp();
        $stamp->updateStamp($data, $data['id']);

        // Redirection vers la liste des timbres
        header('Location: ' . BASE . '/stamp');
        exit;
    }

    // Supprime un timbre
    public function delete($data) {
        if (!isset($data['id']) || empty($data['id'])) {
            return View::render('error', ['msg' => 'Invalid stamp ID']); // ID manquant ou invalide
        }

        $stamp = new Stamp();
        $stamp->deleteStamp($data['id']); // Suppression du timbre

        // Redirection vers la liste des timbres
        header('Location: ' . BASE . '/stamp');
        exit;
    }
}
?>
