<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once 'db.php';
require_once 'Book.php';

$bookObj = new Book($conn);
$message = "";
$book = null;

// Verifică dacă există ID-ul cărții în URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: books.php');
    exit;
}

$book_id = (int)$_GET['id'];
$book = $bookObj->getBookById($book_id);

if (!$book) {
    $message = "Cartea nu a fost găsită!";
} else {
    // Procesează actualizarea când formularul este trimis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = trim($_POST["title"]);
        $author = trim($_POST["author"]);
        $price = floatval($_POST["price"]);
        $image_url = trim($_POST["image_url"]);
        $description = trim($_POST["description"]);
        
        // Handle file upload if provided
        $image_path = $image_url ? $image_url : $book['image_url']; // Păstrează imaginea existentă dacă nu e furnizată una nouă
        
        if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] == 0) {
            $targetDir = "images/";
            $filename = basename($_FILES["image_file"]["name"]);
            $targetFile = $targetDir . time() . "_" . $filename;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
            
            if (in_array($imageFileType, $allowedTypes)) {
                if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $targetFile)) {
                    // Șterge imaginea veche dacă există și nu este URL
                    if ($book['image_url'] && strpos($book['image_url'], 'http') === false && file_exists($book['image_url'])) {
                        unlink($book['image_url']);
                    }
                    $image_path = $targetFile;
                } else {
                    $message = "Nu s-a putut încărca imaginea.";
                }
            } else {
                $message = "Doar fișierele JPG, JPEG, PNG și GIF sunt permise.";
            }
        }
        
        // Actualizează cartea în baza de date
        if (empty($message)) {
            if ($bookObj->updateBook($book_id, $title, $author, $price, $image_path, $description)) {
                $message = "Cartea a fost actualizată cu succes!";
                // Reîncarcă datele cărții pentru a afișa valorile actualizate
                $book = $bookObj->getBookById($book_id);
            } else {
                $message = "Nu s-a putut actualiza cartea.";
            }
        }
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Edit Book</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 2em;
        }
        .form-group {
            margin-bottom: 1.5em;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5em;
            font-weight: bold;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.8em;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
        }
        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }
        .button-group {
            display: flex;
            gap: 1em;
            justify-content: center;
            margin-top: 2em;
        }
        .message {
            padding: 1em;
            margin-bottom: 1em;
            border-radius: 4px;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }
        .current-image {
            max-width: 200px;
            height: auto;
            border-radius: 5px;
            margin-top: 0.5em;
        }
    </style>
</head>
<body class="is-preload">

<header id="header">
    <h1>Editează Cartea</h1>
    <p>Modifică detaliile cărții</p>
</header>

<section id="edit-book">
    <div class="container">
        <?php if (!empty($message)): ?>
            <div class="message">
                <strong><?= htmlspecialchars($message) ?></strong>
            </div>
        <?php endif; ?>
        
        <?php if ($book): ?>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Titlu:</label>
                    <input type="text" name="title" id="title" value="<?= htmlspecialchars($book['title']) ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="author">Autor:</label>
                    <input type="text" name="author" id="author" value="<?= htmlspecialchars($book['author']) ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="price">Preț (€):</label>
                    <input type="number" step="0.01" name="price" id="price" value="<?= $book['price'] ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="image_url">URL imagine:</label>
                    <input type="text" name="image_url" id="image_url" value="<?= htmlspecialchars($book['image_url']) ?>">
                    <?php if (!empty($book['image_url'])): ?>
                        <div>
                            <p>Imaginea curentă:</p>
                            <img src="<?= htmlspecialchars($book['image_url']) ?>" alt="Current Image" class="current-image">
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="image_file">Sau încarcă o imagine nouă:</label>
                    <input type="file" name="image_file" id="image_file" accept="image/*">
                </div>
                
                <div class="form-group">
                    <label for="description">Descriere:</label>
                    <textarea name="description" id="description" rows="5"><?= htmlspecialchars($book['description']) ?></textarea>
                </div>
                
                <div class="button-group">
                    <input type="submit" value="Actualizează Cartea" class="button primary">
                    <a href="books.php" class="button">Anulează</a>
                </div>
            </form>
        <?php else: ?>
            <p>Cartea nu a fost găsită.</p>
            <a href="books.php" class="button">Înapoi la cărți</a>
        <?php endif; ?>
    </div>
</section>

<footer id="footer">
    <p>&copy; 2025 Tincu Cosmin-David</p>
</footer>

<script src="assets/js/main.js"></script>
</body>
</html>