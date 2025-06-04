<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav id="nav" class="fixed-nav">
    <ul>
        <li><a href="index.php">Acasa</a></li>
        <li><a href="books.php">Carti</a></li>
        <li><a href="login.php">Login/Admin</a></li>
        <li><a href="register.php">Register</a></li>
        <?php if (isset($_SESSION['user_id'])): ?>
            <!--<li><a href="admin.php">Admin</a></li>-->
            <li><a href="add.php">Adauga o carte</a></li>
            <!--<li><a href="delete.php">Delete Book</a></li>-->
            <li><a href="logout.php">Log out</a></li>
        <?php endif; ?>
    </ul>
</nav>

