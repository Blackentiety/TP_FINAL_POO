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

//$admin = new Utilisateur();
//$admin->setUsername("admin");
//$admin->setPassword("admin");
//$admin->setEmail("admin@example.com");
//$admin->setRole("ROLE_ADMIN");
//
//$userManager = new UtilisateurManager($db);
//$userManager->addAdmin($admin);

