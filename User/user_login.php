<?php
include "connection.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="user_login.css">
    <link rel="shortcut icon" href="book.png" type="image/x-icon">
</head>
<body>
    
        <div class="login-container">
        <h1>vault</h1>
        <form id="loginForm" action="" method="post">
            
       
            
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
        <p>Not registered yet? <a href="register.php">Register Now</a></p>
    </div>
    <script src="user_login.js"></script>

    <?php
    if (isset($_POST['login'])) {
        
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        
        
        $query = "SELECT * FROM `student_register` WHERE username='$username' AND password='$password'";
        $res = mysqli_query($db, $query);
        
        
        if ($res === false) {
            
            echo "Query error: " . mysqli_error($db);
        } else {
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                
                ?>
                <script type="text/javascript">
                window.location.href = "ind.php";
                </script>
                <?php
            } else {
                
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
