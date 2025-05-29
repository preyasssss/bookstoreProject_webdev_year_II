<?php
class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
        session_start(); // Start session when class is used
    }

    public function register($username, $password) {
        $passwordHash = $password;
        $stmt = $this->conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        return $stmt->execute([$username, $passwordHash]);
    }

    public function login($username, $password) {
        $stmt = $this->conn->prepare("SELECT id, password FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $password == $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            return true;
        }

        return false;
    }

    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public function logout() {
        session_destroy();
    }
}
?>
