
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? "Cubic Market" ?></title>
<link rel="stylesheet" href="/public/style.css">
</head>

<body>

<?php include __DIR__ . '/../fragment/navbar.php'; ?>

<main>
    <?= $produit ?>
</main>

</body>
</html>
