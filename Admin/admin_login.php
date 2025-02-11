<?php
include "connection.php"; // Ensure the connection is correct
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vault - Login</title>
    <link rel="stylesheet" href="admin_login.css">
    <link rel="shortcut icon" href="book.png" type="image/x-icon">
</head>
<body>
    <div class="login-container">
        <h1>Vault Admin</h1>
        <form id="loginForm" action="" method="post">
            <div class="form-group">
                <label for="role">Login as:</label>
                <select id="role" name="role" required>
                    <option value="" disabled selected>Select Role</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter Username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>
            </div>
           
            <button type="submit" name="login">Login</button>
        </form>
        <p id="error-message" class="error-message"></p>
        <p>Not registered yet? <a href="admin_register.php">Register Now</a></p>
    </div>
    <script src="admin_login.js"></script>
    
    <?php
    if (isset($_POST['login'])) {
        // Sanitize inputs to avoid SQL injection
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        
        // Query to check username and password
        $query = "SELECT * FROM `admin_register` WHERE username='$username' AND password='$password'";
        $res = mysqli_query($db, $query);
        
        // Check if query ran successfully
        if ($res === false) {
            // Display query error (for development purposes, should be logged instead in production)
            echo "Query error: " . mysqli_error($db);
        } else {
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                // If login is successful, redirect to ind.php
                ?>
                <script type="text/javascript">
                    window.location.href = "ind.php";
                </script>
                <?php
            } else {
                // If login fails, display error message
                ?>
                <div class="alert alert-danger" style="width: 600px; margin-left: 370px; background-color: #de1313; color: white">
                    <strong>The username and password don't match</strong>
                </div>
                <?php
            }
        }
    }
    ?>
</body>
</html>
