<?php ob_start(); ?>

<h1>Inscription</h1>

<form action="/CubicMarket/public/inscription" method="post" class="register-form">

    <label for="username">Nom d'utilisateur</label>
    <input type="text" name="username" id="username" required>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>

    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" required>

    <label for="password_confirm">Confirmer le mot de passe</label>
    <input type="password" name="password_confirm" id="password_confirm" required>

    <button type="submit">Créer mon compte</button>

</form>

<?php
$content = ob_get_clean();
$title = "Inscription";
include __DIR__ . '/../Template/base.php';
