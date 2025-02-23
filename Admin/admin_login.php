<?php 
include "connection.php"; 
session_start(); 
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
        <form id="loginForm" action="admin_login.php" method="post">
            
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
        
        <p id="error-message" class="error-message">
            <?php
            // Display error message if any
            if (isset($error_message)) {
                echo $error_message;
            }
            ?>
        </p>

        <p>Not registered yet? <a href="admin_register.php">Register Now</a></p>
    </div>

    <?php
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // Ensure correct table name with backticks
    $query = "SELECT * FROM `admin_register` WHERE username='$username'";
    $res = mysqli_query($db, $query);

    if ($res === false) {
        // SQL query error
        echo "Query error: " . mysqli_error($db);
    } else {
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            $row = mysqli_fetch_assoc($res);
            
           
if ($password == $row['password']) {
    $_SESSION['username'] = $username;
    ?>
    <script type="text/javascript">
    window.location.href = "admin-dashboard.html";
    </script>
    <?php
} else {
    
    $error_message = "Invalid username or password.";
}
} else {
   
    $error_message = "Invalid username or password.";
}

    }
}
?>
</body>
</html>
