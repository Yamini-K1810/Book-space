<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Library Management System</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <h1>Library Management System</h1>
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="view_books.php">View Books</a>
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <a href="add_book.php">Add Book</a>
            <?php endif; ?>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
