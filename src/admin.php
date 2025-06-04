<?php
session_start();
// Include verificarea de autentificare (cu auto-login)
include 'autoLogin.php';

// Verifică dacă utilizatorul este logat, altfel redirectează
requireLogin();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Area</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="page-content">
        <h1>Bun venit, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
        <p>Acesta este un hub protejat, doar pentru administratori</p>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>