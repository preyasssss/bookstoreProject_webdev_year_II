<?php
class Book {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllBooks() {
        $result = $this->conn->query("SELECT * FROM books");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getBookById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM books WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function addBook($title, $author, $price, $image) {
        $stmt = $this->conn->prepare("INSERT INTO books (title, author, price, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $title, $author, $price, $image);
        return $stmt->execute();
    }

    public function deleteBook($id) {
        $stmt = $this->conn->prepare("DELETE FROM books WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function updateBook($id, $title, $author, $price, $image) {
        $stmt = $this->conn->prepare("UPDATE books SET title=?, author=?, price=?, image=? WHERE id=?");
        $stmt->bind_param("ssdsi", $title, $author, $price, $image, $id);
        return $stmt->execute();
    }
}
?>
