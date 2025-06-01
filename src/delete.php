<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once 'db.php';
require_once 'Book.php';

$bookObj = new Book($conn);

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];
    $bookObj->deleteBook($id);
}

// Redirect AFTER deleting and BEFORE any output
header("Location: books.php");
exit;
