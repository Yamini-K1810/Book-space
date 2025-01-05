<?php
session_start();
include('config/db.php');

// Ensure the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit();
}

// Get the user ID from session
$user_id = $_SESSION['user_id'];

// Fetch borrowed books of the logged-in user
$sql = "SELECT br.id, b.title, b.author, br.borrow_date, br.return_date 
        FROM borrow_records br
        JOIN books b ON br.book_id = b.id
        WHERE br.user_id = '$user_id' AND br.status = 'borrowed'";
$result = $conn->query($sql);

// Handle book return action
if (isset($_GET['return_id'])) {
    $return_id = $_GET['return_id'];

    // Update the borrow record status to 'returned'
    $sql_return = "UPDATE borrow_records SET status = 'returned' WHERE id = '$return_id'";
    if ($conn->query($sql_return) === TRUE) {
        // Update the book's availability
        $sql_update_book = "UPDATE books SET available = TRUE WHERE id = (SELECT book_id FROM borrow_records WHERE id = '$return_id')";
        $conn->query($sql_update_book);
        
        echo "<p>Book returned successfully.</p>";
    } else {
        echo "<p>Error returning the book.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Book - Library Management System</title>
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
        <h2>My Borrowed Books</h2>
        
        <?php
        if ($result->num_rows > 0) {
            echo "<ul class='borrowed-books'>";
            while ($row = $result->fetch_assoc()) {
                echo "<li>";
                echo "<h3>" . $row['title'] . "</h3>";
                echo "<p><strong>Author:</strong> " . $row['author'] . "</p>";
                echo "<p><strong>Borrowed On:</strong> " . $row['borrow_date'] . "</p>";
                echo "<p><strong>Return By:</strong> " . $row['return_date'] . "</p>";
                echo "<a href='return_book.php?return_id=" . $row['id'] . "' class='btn'>Return Book</a>";
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>You have not borrowed any books.</p>";
        }
        ?>
    </div>

    <footer>
        <p>&copy; 2024 Library Management System</p>
    </footer>
</body>
</html>
