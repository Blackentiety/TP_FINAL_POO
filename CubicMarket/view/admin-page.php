<?php ob_start(); ?>

<section class="admin-section">
    <h2>Gestion des utilisateurs</h2>

    <?php if (!empty($utilisateurs)): ?>
        <table class="admin-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nom d'utilisateur</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($utilisateurs as $user): ?>
                <tr>
                    <td><?= $user->getId() ?></td>
                    <td><?= htmlspecialchars($user->getUsername()) ?></td>
                    <td><?= htmlspecialchars($user->getEmail()) ?></td>
                    <td>
                        <a href="/public/index.php?page=edit-user&id=<?= $user->getId() ?>" class="btn-small">Modifier</a>
                        <a href="/public/index.php?page=delete-user&id=<?= $user->getId() ?>" class="btn-small btn-danger">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    <?php else: ?>
        <p>Aucun utilisateur trouvé.</p>
    <?php endif; ?>
</section>


<section class="admin-section">
    <h2>Gestion des produits</h2>

    <a href="/public/index.php?page=add-product" class="btn">Ajouter un produit</a>

    <?php if (!empty($produits)): ?>
        <table class="admin-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($produits as $produit): ?>
                <tr>
                    <td><?= $produit->getId() ?></td>
                    <td><?= htmlspecialchars($produit->getNom()) ?></td>
                    <td><?= htmlspecialchars($produit->getPrix()) ?> €</td>
                    <td>
                        <a href="/public/index.php?page=edit-product&id=<?= $produit->getId() ?>" class="btn-small">Modifier</a>
                        <a href="/public/index.php?page=delete-product&id=<?= $produit->getId() ?>" class="btn-small btn-danger">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    <?php else: ?>
        <p>Aucun produit trouvé.</p>
    <?php endif; ?>
</section>

<?php
$content = ob_get_clean();
$title = "Administration";
include __DIR__ . '/../Template/base.php';
?>
