<?php
session_start();
session_destroy(); // Destroy the session

// Debugging
echo "Redirecting to: ind.php";
header("Location: ind.php");
exit();
?>
