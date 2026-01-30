<?php global $produits;
ob_start();
$produits = isset($produits) ? $produits : [];

?>

<h1>Bienvenue sur Cubic Market</h1>
<p>Découvrez tous nos produits disponibles.</p>

<div class="products">
    <?php foreach ($produits as $produit): ?>
        <div class="product-card">
            <img src="/public/images/<?= htmlspecialchars($produit->getImage()) ?>"
                 alt="<?= htmlspecialchars($produit->getNom()) ?>">

            <h3><?= htmlspecialchars($produit->getNom()) ?></h3>

            <p><?= htmlspecialchars($produit->getDescription()) ?></p>

            <span class="price"><?= htmlspecialchars($produit->getPrix()) ?> €</span>

            <a class="btn" href="/CubicMarket/public/product?id=<?= $produit->getId() ?>">
                Voir le produit
            </a>
        </div>
    <?php endforeach; ?>
</div>

<?php
$content = ob_get_clean();
$title = "Accueil";
include __DIR__ . '/../template/base.php';
?>

