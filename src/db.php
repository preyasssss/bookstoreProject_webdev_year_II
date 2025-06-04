<?php
$host = 'db'; // docker-compose service name
$user = 'root';
$pass = 'root';
$dbname = 'bookstore';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>