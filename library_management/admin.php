<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];

    $stmt = $conn->prepare("INSERT INTO books (title, author, genre) VALUES (:title, :author, :genre)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':author', $author);
    $stmt->bindParam(':genre', $genre);

    try {
        $stmt->execute();
        echo json_encode(["message" => "Book added successfully"]);
    } catch (PDOException $e) {
        echo json_encode(["error" => "Error: " . $e->getMessage()]);
    }
}
?>
