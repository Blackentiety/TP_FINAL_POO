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
        $produitManager = new ProduitManager($db);
        $produits = $produitManager->getAll();

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
                $_SESSION['role'] = $user['user_Role'] ?? null; // Stocke le rôle

                if (isset($user['user_Role']) && $user['user_Role'] === 'ROLE_ADMIN') {
                    header('Location: /CubicMarket/public/admin');
                } else {
                    header('Location: /CubicMarket/public/home');
                }
                exit;
            } else {
                $error = "Identifiants invalides";
            }
        }
        require '../view/login.php';
        break;
    case '/product':
        $id = $_GET['id'] ?? null;

        $produit = null;

        if ($id) {
            $produitManager = new ProduitManager($db);
            $produit = $produitManager->getById($id);
        }

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
    case '/admin':
        if (!isset($_SESSION['user']) || ($_SESSION['role'] ?? '') !== 'ROLE_ADMIN') {
            header('Location: /CubicMarket/public/login');
            exit;
        }

        $produitManager = new ProduitManager($db);
        $armeManager = new ArmeManager($db);
        $gradeManager = new GradeManager($db);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
            $type = $_POST['type'] ?? '';

            if ($type === 'arme') {
                // On crée l'objet Arme et on hydrate
                $arme = new Arme();
                $arme->setNom($_POST['nom']);
                $arme->setDescription($_POST['description']);
                $arme->setPrix($_POST['prix']);
                $arme->setDegat($_POST['degats']);
                $arme->setDistance($_POST['range']); // Rappel : utilise les ` ` en SQL pour Range
                
                $armeManager->add($arme);
            } 
            elseif ($type === 'grade') {
                $grade = new Grade();
                $grade->setNom($_POST['nom']);
                $grade->setPrivilege($_POST['privilege']);
                $grade->setIdProduit($_POST['produit_id']);
                $gradeManager->add($grade);
            }

            header('Location: /CubicMarket/public/admin');
            exit;
        }

        $produits = $produitManager->getAll();
        require '../view/admin-page.php';
        break;

    default:
        http_response_code(404);
        echo "Page non trouvée";
        break;
}
