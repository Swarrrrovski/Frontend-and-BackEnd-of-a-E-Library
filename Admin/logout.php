<?php 
session_start();
session_destroy(); // Destroy the session

// Debugging
echo "Redirecting to: /libraryphp/ind.php";

// Corrected path
header("Location: /libraryphp/ind.php"); 
exit();
?>
