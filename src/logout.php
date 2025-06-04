<?php
session_start();

// Distruge sesiunea
session_unset();
session_destroy();

// Șterge cookie-urile de autentificare
if (isset($_COOKIE['rememberme'])) {
    setcookie('rememberme', '', time() - 3600, "/");
}

header('Location: login.php');
exit;
?>