<?php
if (!isset($produit)) {
    $produit = null;
}

ob_start();
?>

<?php if ($produit): ?>

    <div class="product-details-container">

        <div class="product-image">
            <img src="/public/images/<?= htmlspecialchars($produit->getImage()) ?>"
                 alt="<?= htmlspecialchars($produit->getNom()) ?>">
        </div>

        <div class="product-info">
            <h1><?= htmlspecialchars($produit->getNom()) ?></h1>

            <p><strong>Description :</strong><br>
                <?= htmlspecialchars($produit->getDescription()) ?>
            </p>

            <p><strong>Prix :</strong>
                <?= htmlspecialchars($produit->getPrix()) ?> €
            </p>

            <p><strong>Stock :</strong>
                <?= htmlspecialchars($produit->getQuantite()) ?>
            </p>

            <a href="/CubicMarket/public/home" class="btn">Retour aux produits</a>
        </div>

    </div>

<?php else: ?>

    <p>Produit introuvable.</p>

<?php endif; ?>

<?php
$content = ob_get_clean();
$title = "Détails du produit";
include __DIR__ . '/../Template/base.php';
?>
