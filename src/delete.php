<?php
include 'db.php';
include 'Book.php';

$bookObj = new Book($conn);

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];
    $bookObj->deleteBook($id);
}

header("Location: books.php");
exit;
