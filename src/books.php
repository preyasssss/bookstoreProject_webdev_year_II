<?php
session_start();
require_once 'db.php';
require_once 'Book.php';
$bookObj = new Book($conn);
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$books = $search ? $bookObj->searchBooks($search) : $bookObj->getAllBooks();
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Bookstore</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            padding-top: 1300px; /* Spatiu sub navbar */
        }
        section#books .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2em;
            padding: 2em 0;
        }
        .book-card {
            background: #2e2e2e;
            border-radius: 10px;
            padding: 1.5em;
            color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .book-card img {
            max-width: 100%;
            height: 250px;
            object-fit: cover;
            margin-bottom: 1em;
            border-radius: 5px;
        }
        .book-card h2 {
            margin-top: 0;
            font-size: 1.5em;
        }
        .book-card .actions {
            margin-top: 1em;
            text-align: center;
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        .button.edit {
            background-color: #4CAF50;
            color: white;
        }
        .button.edit:hover {
            background-color: #45a049;
        }
        .button.danger {
            background-color: #f44336;
            color: white;
        }
        .button.danger:hover {
            background-color: #da190b;
        }
    </style>
</head>
<body class="is-preload">
<?php include 'navbar.php'; ?>
<header id="header">
    <h1>Bun venit in libraria noastra!</h1>
    <p>Va invitam sa va uitati prin cartile noastre!</p>
</header>
<section id="search">
    <form method="get" action="books.php">
        <input type="text" name="search" placeholder="Cautati dupa titlu sau autor" value="<?= htmlspecialchars($search) ?>" />
        <button type="submit" class="button">Search</button>
    </form>
</section>
<section id="books">
    <div class="container">
        <?php if (empty($books)): ?>
            <p>Nicio carte.</p>
        <?php else: ?>
            <div class="grid">
                <?php foreach ($books as $book): ?>
                    <div class="book-card">
                        <?php if (!empty($book['image_url'])): ?>
                            <img src="<?= htmlspecialchars($book['image_url']) ?>" alt="Book Image">
                        <?php endif; ?>
                        <h2><?= htmlspecialchars($book['title']) ?></h2>
                        <p><strong>Autor:</strong> <?= htmlspecialchars($book['author']) ?></p>
                        <p><strong>Pret:</strong> €<?= number_format($book['price'], 2) ?></p>
                        <p><?= nl2br(htmlspecialchars($book['description'])) ?></p>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <div class="actions">
                                <a href="edit.php?id=<?= $book['id'] ?>" class="button small edit">Edit</a>
                                <form action="delete.php" method="get" onsubmit="return confirm('Are you sure you want to delete this book?');" style="display: inline;">
                                    <input type="hidden" name="id" value="<?= $book['id'] ?>">
                                    <input type="submit" value="Delete" class="button small danger">
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<!-- Footer -->
<footer id="footer">
    <p>&copy; 2025 Tincu Cosmin-David 2025</p>
</footer>
<script src="assets/js/main.js"></script>
</body>
</html>