<?php
require 'db.php';
require 'User.php';

$user = new User($conn);
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($user->register($_POST['username'], $_POST['password'])) {
        $message = "User registered successfully.";
    } else {
        $message = "Error registering user.";
    }
}
?>

<form method="post">
    <h2>Register</h2>
    <label>Username: <input type="text" name="username" required></label><br>
    <label>Password: <input type="password" name="password" required></label><br>
    <button type="submit">Register</button>
</form>
<p><?= $message ?></p>
<a href="login.php">Already have an account? Login</a>
