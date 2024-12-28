<?php
session_start();
include('config/db.php');

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email already exists in the database
    $sql_check = "SELECT * FROM users WHERE email = '$email'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        // If the email exists, redirect to login page
        header("Location: index.php");
        exit();
    } else {
        // If the email doesn't exist, hash the password and insert into the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$hashed_password', 'user')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Registration successful! Please <a href='index.php'>login</a>.</p>";
        } else {
            echo "<p>Error: " . $conn->error . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Library Management System</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="navbar">
        <h2>Library Management System</h2>
    </div>

    <div class="container">
        <div class="registration-form">
            <h2>Register</h2>
            <form method="POST" action="register.php">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>

                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>

                <button type="submit" class="btn">Register</button>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Library Management System</p>
    </footer>

</body>
</html>
