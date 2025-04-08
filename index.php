<?php
session_start();

// Chargement automatique des classes via Composer
require_once __DIR__ . '/vendor/autoload.php';

// Inclusion du fichier de configuration de l'application
require_once __DIR__ . '/config.php';

// Inclusion du fichier de définition des routes
require_once __DIR__ . '/App/Routes/web.php';

// var_dump($_SERVER);
// die();
