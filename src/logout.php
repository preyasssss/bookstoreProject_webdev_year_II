<?php
session_start();
session_unset();
session_destroy();

// Clear the remember me cookie too
if (isset($_COOKIE['rememberme'])) {
    setcookie('rememberme', '', time() - 3600, "/");
}

header('Location: login.php');
exit;
?>
