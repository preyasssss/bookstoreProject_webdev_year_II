<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<style>
    .top-navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background: #333;
        padding: 10px 20px;
        z-index: 9999;
        display: flex;
        justify-content: center;
        gap: 20px;
    }

    .top-navbar a {
        color: white;
        text-decoration: none;
        font-weight: bold;
    }

    .page-content {
        margin-top: 70px; /* Adjust based on navbar height */
    }
</style>

<div class="top-navbar">
    <a href="index.php">Home</a>
    <a href="books.php">Books</a>
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
    <a href="admin.php">Admin</a>
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="add.php">Add Book</a>
        <a href="delete.php">Delete Book</a>
        <a href="logout.php">Logout</a>
    <?php endif; ?>
</div>
