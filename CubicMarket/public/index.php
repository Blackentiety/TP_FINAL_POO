<?php
spl_autoload_register(function ($class) {
    $file = str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) require $file;
});

use src\Entities\shop\Produit;
use src\Entities\shop\Grade;
use src\Entities\shop\Arme;
use src\Manager\shop\GradeManager;
use src\Manager\shop\ProduitManager;
use src\Manager\shop\ArmeManager;

require_once "../config/db.php";


