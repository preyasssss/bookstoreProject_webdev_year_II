<?php
session_start();
require_once 'db.php';
include 'navbar.php';
// If user not logged in but remember me cookie exists, auto-login
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
        // Invalid cookie, clear it
        setcookie('rememberme', '', time() - 3600, "/");
    }
}

// Now check if logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<div class="page-content">
    <!-- All your page content starts here -->
</div>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Area</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <h1>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
    <p>This is the protected admin area.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
