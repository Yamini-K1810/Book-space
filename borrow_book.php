<?php
session_start();
include('config/db.php');

// Ensure user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book_id'])) {
    $book_id = $_POST['book_id'];
    $user_id = $_SESSION['user_id'];
    $borrow_date = date("Y-m-d");

    // Insert borrow record into the database
    $sql = "INSERT INTO borrow_records (user_id, book_id, borrow_date) VALUES ('$user_id', '$book_id', '$borrow_date')";
    if ($conn->query($sql) === TRUE) {
        // Update book availability to false (borrowed)
        $update_sql = "UPDATE books SET available = 0 WHERE id = '$book_id'";
        $conn->query($update_sql);
        echo "Book borrowed successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrow Book - Library Management System</title>
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
            <h2>Borrow a Book</h2>
            <div class="book-list">
                <?php
                // Fetch available books from the database
                $sql = "SELECT * FROM books WHERE available = 1";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='book-item'>";
                        echo "<h3>" . $row['title'] . "</h3>";
                        echo "<p><strong>Author:</strong> " . $row['author'] . "</p>";
                        echo "<p><strong>Category:</strong> " . $row['category'] . "</p>";
                        echo "<form method='POST' action='borrow_book.php'>";
                        echo "<input type='hidden' name='book_id' value='" . $row['id'] . "'>";
                        echo "<button type='submit' class='btn'>Borrow</button>";
                        echo "</form>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No available books to borrow.</p>";
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
