<?php
session_start();
include('config/db.php');

// Ensure user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit();
}

// Fetch books from the database
$sql = "SELECT * FROM books";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Books - Library Management System</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="navbar">
        <h2>Library Management System</h2>
        <div class="user-info">
            <p>Welcome, <?php echo $_SESSION['email']; ?></p>
            <a href="logout.php" class="btn">Logout</a>
        </div>
    </div>

    <div class="container">
        <div class="sidebar">
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="view_books.php">View Books</a></li>
                <li><a href="borrow_book.php">Borrow Book</a></li>
                <li><a href="return_book.php">Return Book</a></li>
            </ul>
        </div>

        <div class="content">
            <h2>All Books</h2>
            <div class="book-list">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='book-item'>";
                        echo "<h3>" . $row['title'] . "</h3>";
                        echo "<p><strong>Author:</strong> " . $row['author'] . "</p>";
                        echo "<p><strong>Category:</strong> " . $row['category'] . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No books available.</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Library Management System</p>
    </footer>
</body>
</html>
