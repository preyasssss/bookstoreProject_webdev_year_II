<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include 'db.php';
include 'Book.php';

$bookObj = new Book($conn);
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST["title"]);
    $author = trim($_POST["author"]);
    $price = floatval($_POST["price"]);
    $image_url = trim($_POST["image_url"]);
    $description = trim($_POST["description"]);

    // Handle file upload if provided
    $image_path = $image_url; // Default to the URL field

    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] == 0) {
        $targetDir = "images/";
        $filename = basename($_FILES["image_file"]["name"]);
        $targetFile = $targetDir . time() . "_" . $filename;

        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageFileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $targetFile)) {
                $image_path = $targetFile;
            } else {
                $message = "Failed to upload image.";
            }
        } else {
            $message = "Only JPG, JPEG, PNG & GIF files are allowed.";
        }
    }

    // Save to DB using the final $image_path
    if ($bookObj->addBook($title, $author, $price, $image_path, $description)) {
        $message = "Book added successfully!";
    } else {
        $message = "Failed to add book.";
    }

}

?>
<div class="page-content">
    <!-- All your page content starts here -->
</div>
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
        <form method="POST" action="" enctype="multipart/form-data">
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

            <label for="image_file">Upload Image:</label>
            <input type="file" name="image_file" id="image_file"><br>


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
<a href="books.php" class="button back-button">Back to Books</a>

<style>
    .back-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
    }
</style>

</body>
</html>
