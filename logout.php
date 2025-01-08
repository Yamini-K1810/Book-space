<?php
session_start();

// Clear session variables and destroy the session
session_unset();  
session_destroy();  

// Redirect to login page
header("Location: index.php");
exit();  // Stop further script execution
?>
