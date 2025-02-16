<?php 
include "connection.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vault - Login</title>
    <link rel="stylesheet" href="user_login.css">
    <link rel="shortcut icon" href="book.png" type="image/x-icon">
</head>
<body>
    <div class="login-container">
        <h1>Vault Student</h1>
        <form id="loginForm" action="" method="post">
            <div class="form-group">
                <label for="role">Login as:</label>
                <select id="role" name="role" required>
                    <option value="" disabled selected>Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
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
        
        <!-- Error message placeholder -->
        <p id="error-message" class="error-message">
            <?php
            // Display error message from PHP if exists
            if (isset($error_message)) {
                echo $error_message;
            }
            ?>
        </p>
        
        <p>Not registered yet? <a href="register.php">Register Now</a></p>
    </div>

    <script src="user_login.js"></script>

    <?php
    if (isset($_POST['login'])) {
        
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        
        // Query to check the username and password
        $query = "SELECT * FROM `student_register` WHERE username='$username' AND password='$password'";
        $res = mysqli_query($db, $query);
        
        if ($res === false) {
            // Query error
            echo "Query error: " . mysqli_error($db);
        } else {
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                // If match found, redirect to ind.php
                ?>
                <script type="text/javascript">
                window.location.href = "ind.php";
                </script>
                <?php
            } else {
                // If no match, set error message
                $error_message = "The username and password don't match.";
            }
        }
    }
    ?>
</body>
</html>
