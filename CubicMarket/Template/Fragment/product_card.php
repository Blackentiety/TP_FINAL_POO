<div class="product-card">

    <img src="/public/images/<?= htmlspecialchars($produit->getImage()) ?>"
         alt="<?= htmlspecialchars($produit->getNom()) ?>">

    <h3><?= htmlspecialchars($produit->getNom()) ?></h3>

    <p class="price"><?= htmlspecialchars($produit->getPrix()) ?> €</p>

    <a href="/CubicMarket/public/product?id=<?= $produit->getId() ?>"> Voir le produit </a>

</div>
