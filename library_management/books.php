<?php
require 'db.php';

$stmt = $conn->prepare("SELECT * FROM books");
$stmt->execute();
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($books);
?>
