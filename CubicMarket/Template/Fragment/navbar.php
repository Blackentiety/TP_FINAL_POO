<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$isConnected = !empty($_SESSION['user']);
?>
<nav class="navbar">
    <ul>
        <li><a href="/CubicMarket/public/home">Accueil</a></li>
        <?php if ($isConnected): ?>
            <li><a href="/CubicMarket/public/logout">Déconnexion</a></li>
        <?php else: ?>
            <li><a href="/CubicMarket/public/login">Connexion</a></li>
        <?php endif; ?>
    </ul>
</nav>
