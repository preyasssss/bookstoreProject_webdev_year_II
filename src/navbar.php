<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav id="nav" class="fixed-nav">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="books.php">Books</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
        <li><a href="admin.php">Admin</a></li>
        <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="add.php">Add Book</a></li>
            <li><a href="delete.php">Delete Book</a></li>
        <?php endif; ?>
    </ul>
</nav>

