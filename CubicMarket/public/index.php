<?php
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) require $file;
});

use src\Entities\shop\Produit;
use src\Entities\shop\Grade;
use src\Entities\shop\Arme;
use src\Entities\user\Utilisateur;
use src\Manager\shop\GradeManager;
use src\Manager\shop\ProduitManager;
use src\Manager\shop\ArmeManager;
use src\Manager\user\UtilisateurManager;

require_once "../config/db.php";

// Récupère le chemin demandé
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Retire le chemin de base du projet si besoin
$base = '/CubicMarket/public/';
if (strpos($uri, $base) === 0) {
    $uri = substr($uri, strlen($base));
}
if ($uri === '' || $uri === '/') $uri = '/home';

// Routage basique
switch ($uri) {
    case '/':
    case 'home':
        require '../view/home.php';
        break;
    case 'login':
        require '../view/login.php';
        break;
    case 'product':
        require '../view/product_details.php';
        break;
    default:
        http_response_code(404);
        echo "Page non trouvée";
        break;
}
