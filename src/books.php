<?php
include 'db.php';
include 'Book.php';

$bookObj = new Book($conn);
$books = $bookObj->getAllBooks();
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
            <?php foreach ($books as $book): ?>
                <div class="box">
                    <h2><?= htmlspecialchars($book['title']) ?></h2>
                    <p><strong>Author:</strong> <?= htmlspecialchars($book['author']) ?></p>
                    <p><strong>Price:</strong> €<?= number_format($book['price'], 2) ?></p>
                    <?php if (!empty($book['image_url'])): ?>
                        <img src="<?= htmlspecialchars($book['image_url']) ?>" style="max-width: 200px;">
                    <?php endif; ?>
                    <p><?= nl2br(htmlspecialchars($book['description'])) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer id="footer">
        <ul class="icons">
            <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
            <li><a href="#" class="
