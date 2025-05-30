<?php
session_start();
require_once 'db.php';
require_once 'Book.php';

$bookObj = new Book($conn);

// Search logic
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$books = $search ? $bookObj->searchBooks($search) : $bookObj->getAllBooks();
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Bookstore</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <style>
        /* Navbar fix sus */
        nav#nav {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background-color: #1c1c1c;
            padding: 1em 2em;
        }

        body {
            padding-top: 900px; /* Spațiu sub navbar */
        }

        section#books .box {
            margin-bottom: 2em;
        }

        section#search {
            text-align: center;
            margin-top: 20px;
        }

        header#header {
            padding: 2em 0;
            text-align: center;
        }

    </style>
</head>
<body class="is-preload">

<?php include 'navbar.php'; ?>

<!-- Header -->
<header id="header">
    <h1>Welcome to our Bookstore</h1>
    <p>Search through our collection of books below</p>
</header>

<!-- Search Form -->
<section id="search">
    <form method="get" action="books.php">
        <input type="text" name="search" placeholder="Search by title or author" value="<?= htmlspecialchars($search) ?>" />
        <button type="submit" class="button">Search</button>
    </form>
</section>

<!-- Book List -->
<section id="books">
    <div class="container">
        <?php if (empty($books)): ?>
            <p>No books found.</p>
        <?php else: ?>
            <?php foreach ($books as $book): ?>
                <div class="box">
                    <h2><?= htmlspecialchars($book['title']) ?></h2>
                    <p><strong>Author:</strong> <?= htmlspecialchars($book['author']) ?></p>
                    <p><strong>Price:</strong> €<?= number_format($book['price'], 2) ?></p>
                    <?php if (!empty($book['image_url'])): ?>
                        <img src="<?= htmlspecialchars($book['image_url']) ?>" alt="Book Image" style="max-width: 200px;">
                    <?php endif; ?>
                    <p><?= nl2br(htmlspecialchars($book['description'])) ?></p>

                    <?php if (isset($_SESSION['user_id'])): ?>
                        <form action="delete.php" method="get" onsubmit="return confirm('Are you sure you want to delete this book?');">
                            <input type="hidden" name="id" value="<?= $book['id'] ?>">
                            <input type="submit" value="Delete" class="button small danger">
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<!-- Footer -->
<footer id="footer">
    <ul class="icons">
        <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
        <li><a href="#" class="icon brands fa-facebook"><span class="label">Facebook</span></a></li>
    </ul>
    <p>&copy; Your Bookstore</p>
</footer>

<script src="assets/js/main.js"></script>
</body>
</html>
