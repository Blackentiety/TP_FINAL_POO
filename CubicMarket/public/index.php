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
session_start(); // Pour gérer la session utilisateur

// Récupère le chemin demandé
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Retire le chemin de base du projet si besoin
$base = '/CubicMarket/public/';
if (strpos($uri, $base) === 0) {
    $uri = substr($uri, strlen($base));
}
if ($uri === '' || $uri === '/') $uri = '/home';
if ($uri[0] !== '/') $uri = '/' . $uri; // Sécurise le slash

// Routage basique
switch ($uri) {
    case '/':
    case '/home':
        require '../view/home.php';
        break;
    case '/login':
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $userManager = new UtilisateurManager($db);
            $user = $userManager->login($email, $password);
            if ($user && !empty($user['UserID'])) {
                $_SESSION['user'] = $user['UserID'];
                header('Location: /CubicMarket/public/home');
                exit;
            } else {
                $error = "Identifiants invalides";
            }
        }
        require '../view/login.php';
        break;
    case '/product':
        require '../view/product_details.php';
        break;
    case '/inscription':
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $password_confirm = $_POST['password_confirm'] ?? '';

            if ($username && $email && $password && $password_confirm) {
                if ($password === $password_confirm) {
                    $userManager = new UtilisateurManager($db);
                    $utilisateur = new \src\Entities\user\Utilisateur();
                    $utilisateur->setUsername($username);
                    $utilisateur->setEmail($email);
                    $utilisateur->setPassword($password);
                    $userManager->addUtilisateur($utilisateur);
                    header('Location: /CubicMarket/public/login');
                    exit;
                } else {
                    $error = "Les mots de passe ne correspondent pas.";
                }
            } else {
                $error = "Tous les champs sont obligatoires.";
            }
        }
        require '../view/inscription.php';
        break;
    case '/logout':
        session_destroy();
        header('Location: /CubicMarket/public/login');
        exit;
    default:
        http_response_code(404);
        echo "Page non trouvée";
        break;
}
