<?php
include 'db.php';
$result = $conn->query("SELECT * FROM books");
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Bookstore</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="assets/css/main.css" />
</head>
<body class="is-preload">

    <!-- Header -->
    <header id="header">
        <h1>Our Bookstore</h1>
        <p>Search through our collection of books below</p>
    </header>

    <!-- Book List Section -->
    <section id="books">
        <div class="container">
            <?php while($book = $result->fetch_assoc()): ?>
                <div class="box">
                    <h2><?= $book['title'] ?></h2>
                    <p><strong>Author:</strong> <?= $book['author'] ?></p>
                    <p><strong>Price:</strong> €<?= $book['price'] ?></p>
                    <?php if ($book['image_url']): ?>
                        <img src="<?= $book['image_url'] ?>" style="max-width: 200px;">
                    <?php endif; ?>
                    <p><?= $book['description'] ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer id="footer">
        <ul class="icons">
            <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
            <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
            <li><a href="#" class="icon brands fa-github"><span class="label">GitHub</span></a></li>
        </ul>
        <ul class="copyright">
            <li>&copy; Your Bookstore</li>
        </ul>
    </footer>

    <script src="assets/js/main.js"></script>
</body>
</html>
