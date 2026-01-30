<?php ob_start(); ?>

<h1>Connexion</h1>

<form action="/public/index.php?page=login" method="post" class="login-form">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>

    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" required>

    <button type="submit">Se connecter</button>
    <p class="no-account">
        Pas de compte Cubic Market?
        <a href="/public/index.php?page=inscription" class="btn-secondary">Créer un compte</a>
    </p>
</form>

<?php
$content = ob_get_clean();
$title = "Connexion";
include __DIR__ . '/../Template/base.php';
?>
