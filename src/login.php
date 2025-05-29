<?php
session_start();
include 'navbar.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ✅ CAPTCHA validation
    $recaptchaSecret = '6Lf-t00rAAAAAFAivx69pYgGF_9ty6sE9wlAYGVG';
    $recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';

    $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptchaSecret}&response={$recaptchaResponse}");
    $responseData = json_decode($verify);

    if (!$responseData->success) {
        $error = 'CAPTCHA verification failed. Please try again.';
    } else {
        include 'db.php';

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            if ($user['password'] === $password) { // Replace with password_hash() later

                // Set session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                // Set remember me cookie if checked
                if (isset($_POST['remember'])) {
                    setcookie('rememberme', $user['id'], time() + (86400 * 30), "/");
                } else {
                    if (isset($_COOKIE['rememberme'])) {
                        setcookie('rememberme', '', time() - 3600, "/");
                    }
                }

                header('Location: admin.php');
                exit;
            } else {
                $error = 'Wrong password!';
            }
        } else {
            $error = 'User not found!';
        }
    }
}
?>
<div class="page-content">
    <!-- All your page content starts here -->
</div>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        input[type="checkbox"] {
            opacity: 1 !important;
            display: inline-block !important;
            appearance: auto !important;
            -webkit-appearance: checkbox !important;
            width: 16px;
            height: 16px;
            margin-right: 8px;
        }

        label {
            color: white;
        }
    </style>
    


</head>
<body>
    <h2>Login</h2>
    <?php if ($error): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>
    <form method="post" action="login.php">
        <input type="text" name="username" placeholder="Username" 
            value="<?= htmlspecialchars($_COOKIE['username'] ?? '') ?>" required><br><br>

        <input type="password" name="password" placeholder="Password" required><br><br>

        <label style="color: white;">
            <input type="checkbox" name="remember" style="accent-color: white; width: 16px; height: 16px; vertical-align: middle;">
            Remember Me
        </label>

        <div class="g-recaptcha" data-sitekey="6Lf-t00rAAAAAF_Zs_hAkyxr9gvPL0NUv2wpjyEz"></div>

        <input type="submit" value="Log In">
    </form>
</body>
</html>
