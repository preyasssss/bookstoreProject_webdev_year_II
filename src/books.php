<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Librăria noastră!</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/css/main.css" />
</head>
<body class="is-preload">

<header id="header">
    <h1>Librăria noastră!</h1>
    <p>Explorează-ne colecția incredibilă de cărți!</p>
</header>

<section style="padding: 2em;">
    <?php
    $stmt = $pdo->query("SELECT * FROM books");
    while ($book = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<div style="margin-bottom: 2em;">';
        echo '<h2>' . htmlspecialchars($book['title']) . ' by ' . htmlspecialchars($book['author']) . '</h2>';
        echo '<p><strong>Price:</strong> €' . htmlspecialchars($book['price']) . '</p>';
        if (!empty($book['image_url'])) {
            echo '<img src="' . htmlspecialchars($book['image_url']) . '" alt="Book cover" style="max-width:200px;">';
        }
        echo '<p>' . nl2br(htmlspecialchars($book['description'])) . '</p>';
        echo '</div>';
    }
    ?>
</section>

<footer id="footer">
    <ul class="icons">
        <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
        <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
        <li><a href="#" class="icon brands fa-github"><span class="label">GitHub</span></a></li>
    </ul>
</footer>

<script src="../assets/js/main.js"></script>
</body>
</html>
