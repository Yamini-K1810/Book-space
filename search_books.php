<?php
include('config/db.php');

$query = $_GET['query'];
$sql = "SELECT * FROM books WHERE title LIKE '%$query%' OR author LIKE '%$query%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<p>" . $row['title'] . " by " . $row['author'] . "</p>";
        echo "<button onclick='borrowBook(" . $row['id'] . ")'>Borrow</button>";
        echo "</div>";
    }
} else {
    echo "<p>No results found.</p>";
}
?>
