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
           $stamps = new Stamp();
           $countries = $stamps->getOptions('countries');
           $categories = $stamps->getOptions('categories');
           $conditions = $stamps->getOptions('conditions');
           $users = $stamps->getOptions('users');
           $colors = $stamps->getOptions('colors');
        return View::render('stamp/create', compact('countries', 'categories', 'conditions', 'colors', 'users'));
    }

    // Traite la soumission du formulaire de création
public function store($data) {
    $validator = new Validator();

    $validator->field('stamp_code', $data['stamp_code'])->required();
    $validator->field('details', $data['details'])->required()->min(10);
    $validator->field('price', $data['price'])->required()->positiveNumber()->minValue(1);
    $validator->field('certified', $data['certified']);
    $validator->field('creation_date', $data['creation_date'])->required();
    $validator->field('country_id', $data['country_id'])->required();
    $validator->field('color_id', $data['color_id'])->required();
    $validator->field('category_id', $data['category_id'])->required();
    $validator->field('condition_id', $data['condition_id'])->required();
    $validator->field('user_id', $data['user_id'])->required();

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $uniqueName = uniqid() . '.' . $ext;
    $destination = $_SERVER['DOCUMENT_ROOT'] . ASSET . '/img/stamp/' . $uniqueName;
    if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
        $data['image'] = $uniqueName;
    } else {
         $validator->field('image', '')->required();
    }
} else {
    $validator->field('image', '')->required();
}

if (isset($_FILES['image_1']) && $_FILES['image_1']['error'] === UPLOAD_ERR_OK) {
    $ext = pathinfo($_FILES['image_1']['name'], PATHINFO_EXTENSION);
    $uniqueName = uniqid() . '.' . $ext;
    $destination = $_SERVER['DOCUMENT_ROOT'] . ASSET . '/img/stamp/' . $uniqueName;
    if (move_uploaded_file($_FILES['image_1']['tmp_name'], $destination)) {
        $data['image_1'] = $uniqueName;
    }
}
if (isset($_FILES['image_2']) && $_FILES['image_2']['error'] === UPLOAD_ERR_OK) {
    $ext = pathinfo($_FILES['image_2']['name'], PATHINFO_EXTENSION);
    $uniqueName = uniqid() . '.' . $ext;
    $destination = $_SERVER['DOCUMENT_ROOT'] . ASSET . '/img/stamp/' . $uniqueName;
    if (move_uploaded_file($_FILES['image_2']['tmp_name'], $destination)) {
        $data['image_2'] = $uniqueName;
    }
}
if (isset($_FILES['image_3']) && $_FILES['image_3']['error'] === UPLOAD_ERR_OK) {
    $ext = pathinfo($_FILES['image_3']['name'], PATHINFO_EXTENSION);
    $uniqueName = uniqid() . '.' . $ext;
    $destination = $_SERVER['DOCUMENT_ROOT'] . ASSET . '/img/stamp/' . $uniqueName;
    if (move_uploaded_file($_FILES['image_3']['tmp_name'], $destination)) {
        $data['image_3'] = $uniqueName;
    }
}

    if (!$validator->isSuccess()) {
        return View::render('stamp/create', [
            'errors' => $validator->getErrors(),
            'stamp' => $data,
        ]);
    }

    $stamp = new Stamp();
    $stamp->createStamp($data);

    header('Location: ' . BASE . '/stamp');
    exit;
}

    public function show($data) {
        if (!isset($data['id']) || empty($data['id'])) {
            return View::render('error', ['msg' => 'Invalid stamp ID']); 
            }
        $stamp = new Stamp();
        $stampData = $stamp->getStampByIdjoin($data['id']);
        if (!$stampData) {
            return View::render('error', ['msg' => 'Stamp not found']); 
        }
        $bids = $stamp->getBidsByStampId($data['id']);
        return View::render('stamp/show', ['bids' => $bids, 'stamp' => $stampData]);
    }

public function edit($data) {
    if (!isset($data['id']) || empty($data['id'])) {
        return View::render('error', ['msg' => 'Invalid stamp ID']); 
    }
    $stamp = new Stamp();
    $stampData = $stamp->getStampById($data['id']);
    if (!$stampData) {
        return View::render('error', ['msg' => 'Stamp not found']);
    }
    $countries = $stamp->getOptions('countries');
    $categories = $stamp->getOptions('categories');
    $conditions = $stamp->getOptions('conditions');
    $users = $stamp->getOptions('users');
    $colors = $stamp->getOptions('colors');

    return View::render('stamp/edit', [
        'stamp' => $stampData,
        'countries' => $countries,
        'categories' => $categories,
        'conditions' => $conditions,
        'colors' => $colors,
        'users' => $users
    ]);
}

public function update($data) {
    if (!isset($data['id']) || empty($data['id'])) {
        return View::render('error', ['msg' => 'Invalid stamp ID']); // ID ������� �� �� ���
    }

    // ���������� ������
    $validator = new Validator();
    $validator->field('details', $data['details'])->required()->min(3);
    $validator->field('price', $data['price'])->required()->positiveNumber()->minValue(1);
    $validator->field('certified', $data['certified'])->required()->min(1);
    $validator->field('creation_date', $data['creation_date'])->required();
    $validator->field('country_id', $data['country_id'])->required();
    $validator->field('color_id', $data['color_id'])->required();
    $validator->field('category_id', $data['category_id'])->required();
    $validator->field('condition_id', $data['condition_id'])->required();
    $validator->field('user_id', $data['user_id'])->required();
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $uniqueName = uniqid() . '.' . $ext;
    $destination = $_SERVER['DOCUMENT_ROOT'] . ASSET . '/img/stamp/' . $uniqueName;
    if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
        $data['image'] = $uniqueName;
    } else {
         $validator->field('image', '')->required();
    }
}

if (isset($_FILES['image_1']) && $_FILES['image_1']['error'] === UPLOAD_ERR_OK) {
    $ext = pathinfo($_FILES['image_1']['name'], PATHINFO_EXTENSION);
    $uniqueName = uniqid() . '.' . $ext;
    $destination = $_SERVER['DOCUMENT_ROOT'] . ASSET . '/img/stamp/' . $uniqueName;
    if (move_uploaded_file($_FILES['image_1']['tmp_name'], $destination)) {
        $data['image_1'] = $uniqueName;
    }
}
if (isset($_FILES['image_2']) && $_FILES['image_2']['error'] === UPLOAD_ERR_OK) {
    $ext = pathinfo($_FILES['image_2']['name'], PATHINFO_EXTENSION);
    $uniqueName = uniqid() . '.' . $ext;
    $destination = $_SERVER['DOCUMENT_ROOT'] . ASSET . '/img/stamp/' . $uniqueName;
    if (move_uploaded_file($_FILES['image_2']['tmp_name'], $destination)) {
        $data['image_2'] = $uniqueName;
    }
}
if (isset($_FILES['image_3']) && $_FILES['image_3']['error'] === UPLOAD_ERR_OK) {
    $ext = pathinfo($_FILES['image_3']['name'], PATHINFO_EXTENSION);
    $uniqueName = uniqid() . '.' . $ext;
    $destination = $_SERVER['DOCUMENT_ROOT'] . ASSET . '/img/stamp/' . $uniqueName;
    if (move_uploaded_file($_FILES['image_3']['tmp_name'], $destination)) {
        $data['image_3'] = $uniqueName;
    }
}
    $stamp = new Stamp();
    if (!$validator->isSuccess()) {
        $countries = $stamp->getOptions('countries');
        $categories = $stamp->getOptions('categories');
        $conditions = $stamp->getOptions('conditions');
        $users = $stamp->getOptions('users');
        $colors = $stamp->getOptions('colors');
        return View::render('stamp/edit', [
            'errors' => $validator->getErrors(),
            'stamp' => $data,
            'countries' => $countries,
            'categories' => $categories,
            'conditions' => $conditions,
            'users' => $users,
            'colors' => $colors,
        ]);
    }
    $stamp->updateStamp($data, $data['id']);
    header('Location: ' . BASE . '/stamp');
    exit;
}

    public function delete($data) {
        if (!isset($data['id']) || empty($data['id'])) {
            return View::render('error', ['msg' => 'Invalid stamp ID']); // ID manquant ou invalide
        }

        $stamp = new Stamp();
        $stamp->deleteStamp($data['id']); // Suppression du timbre

        header('Location: ' . BASE . '/stamp');
        exit;
    }

public function newbid(){
    print_r($_POST);
    die();
    if (isset($_POST['id']) && isset($_POST['amount']) && isset($_SESSION['user_id'])) {
        $stamp_id = $_POST['id'];
        $auction_id = $_POST['auction_id'];
        $amount = $_POST['amount'];
        $user_id = $_SESSION['user_id'];
        $model = new Stamp();

        $result = $model->insertBid($stamp_id, $user_id, $amount ,$auction_id);

        if ($result) {
            $_SESSION['message'] = 'Offer register successfull';
        } else {
            $_SESSION['message'] = 'offer register error';
        }

        header("Location: " . BASE . "/stamp/show?id=" . $stamp_id);
        exit;
    } else {
        $_SESSION['message'] = 'Error Input Data';
        $stamp_id = $_POST['id'] ?? 0; 
        header("Location: " . BASE . "/stamp/show?id=" . $stamp_id);
        exit;
    }
}
}
?>
