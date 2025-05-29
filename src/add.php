<?php
include 'db.php';
include 'Book.php';

$bookObj = new Book($conn);
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $title = trim($_POST["title"]);
    $author = trim($_POST["author"]);
    $price = floatval($_POST["price"]);
    $image_url = trim($_POST["image_url"]);
    $description = trim($_POST["description"]);

    if ($bookObj->addBook($title, $author, $price, $image_url, $description)) {
        $message = "Book added successfully!";
    } else {
        $message = "Failed to add book.";
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Add Book</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="assets/css/main.css" />
</head>
<body class="is-preload">

    <header id="header">
        <h1>Add a New Book</h1>
        <p>Fill out the form to add a book to the bookstore</p>
    </header>

    <section id="add-book">
        <div class="container">
            <?php if (!empty($message)): ?>
                <p><strong><?= htmlspecialchars($message) ?></strong></p>
            <?php endif; ?>
            <form method="POST" action="">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" required><br>

                <label for="author">Author:</label>
                <input type="text" name="author" id="author" required><br>

                <label for="price">Price:</label>
                <input type="number" step="0.01" name="price" id="price" required><br>

                <label for="image_url">Image URL:</label>
                <input type="text" name="image_url" id="image_url"><br>

                <label for="description">Description:</label><br>
                <textarea name="description" id="description" rows="5"></textarea><br>

                <input type="submit" value="Add Book" class="button primary">
            </form>
        </div>
    </section>

    <footer id="footer">
        <ul class="icons">
            <li><a href="#" class="icon brands fa-twitter"></a></li>
            <li><a href="#" class="icon brands fa-facebook"></a></li>
        </ul>
        <p>&copy; Your Bookstore</p>
    </footer>

    <script src="assets/js/main.js"></script>
</body>
</html>
