<?php
session_start();
include('config/db.php');

// Ensure user is logged in and is an admin
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $category = $_POST['category'];

    // Prepare SQL query to insert the book data
    $sql = "INSERT INTO books (title, author, category) VALUES ('$title', '$author', '$category')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Book added successfully!</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book - Library Management System</title>
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
                <li><a href="add_book.php">Add Book</a></li> <!-- Add Book Link -->
            </ul>
        </div>

        <div class="content">
            <h2>Add a New Book</h2>
            <form method="POST" action="add_book.php">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" required>

                <label for="author">Author:</label>
                <input type="text" name="author" id="author" required>

                <label for="category">Category:</label>
                <input type="text" name="category" id="category" required>

                <button type="submit" class="btn">Add Book</button>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Library Management System</p>
    </footer>
</body>
</html>
