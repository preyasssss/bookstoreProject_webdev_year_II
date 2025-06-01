<?php
session_start();
require_once 'db.php';
include 'navbar.php';
// auto log in daca nu este logat, dar exista cookie
if (!isset($_SESSION['user_id']) && isset($_COOKIE['rememberme'])) {
    $userId = $_COOKIE['rememberme'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
    } else {
        // cookie invalid => il sterge
        setcookie('rememberme', '', time() - 3600, "/");
    }
}

// vf daca e logat
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<div class="page-content">

</div>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Area</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <h1>Bun venit, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
    <p>Acesta este un hub protejat, doar pentru administratori</p>
    <a href="logout.php">Logout</a>
</body>
</html>
