<?php
include 'db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $price = floatval($_POST['price']);
    $description = trim($_POST['description']);
    $image_url = trim($_POST['image_url']); // just a link for now

    if ($title && $author && $price) {
        $stmt = $conn->prepare("INSERT INTO books (title, author, price, image_url, description) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdss", $title, $author, $price, $image_url, $description);

        if ($stmt->execute()) {
            $message = "Book added successfully!";
        } else {
            $message = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $message = "Please fill in all required fields.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Book</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <h1>Add a New Book</h1>

    <?php if ($message): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="post" action="add.php">
        <label>Title*: <input type="text" name="title" required></label><br>
        <label>Author*: <input type="text" name="author" required></label><br>
        <label>Price (€)*: <input type="number" step="0.01" name="price" required></label><br>
        <label>Image URL: <input type="text" name="image_url"></label><br>
        <label>Description: <textarea name="description"></textarea></label><br>
        <input type="submit" value="Add Book">
    </form>

    <a href="books.php">Back to books list</a>
</body>
</html>
