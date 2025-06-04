<?php
// auth_check.php - Include acest fișier în toate paginile protejate
if (!isset($_SESSION)) {
    session_start();
}

require_once 'db.php';

// Auto login dacă nu este logat, dar există cookie valid
if (!isset($_SESSION['user_id']) && isset($_COOKIE['rememberme'])) {
    $userId = $_COOKIE['rememberme'];
    
    // Verifică dacă cookie-ul conține doar cifre (securitate de bază)
    if (is_numeric($userId)) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($user = $result->fetch_assoc()) {
            // Restaurează sesiunea
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            
            // Reînnoiește cookie-ul pentru încă 30 de zile
            setcookie('rememberme', $user['id'], time() + (86400 * 30), "/");
        } else {
            // Cookie invalid => îl șterge
            setcookie('rememberme', '', time() - 3600, "/");
        }
    } else {
        // Cookie invalid => îl șterge
        setcookie('rememberme', '', time() - 3600, "/");
    }
}

// Funcție pentru verificarea dacă utilizatorul este logat
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Funcție pentru redirectare la login dacă nu este autentificat
function requireLogin($redirectTo = 'login.php') {
    if (!isLoggedIn()) {
        header('Location: ' . $redirectTo);
        exit;
    }
}
?>