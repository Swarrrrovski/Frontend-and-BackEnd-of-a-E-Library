<?php  
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vault-Registration</title>
    <link rel="stylesheet" href="register.css">
    <link rel="shortcut icon" href="book.png" type="image/x-icon">
</head>
<body>
    <div class="role-selection">
        <h1>Register</h1>
        <button class="role-btn" onclick="selectRole('Admin')">Admin</button>
        <button class="role-btn" onclick="selectRole('User')">User</button>
    </div>

    <div class="registration-container" id="registrationContainer" style="display: none;">
        <h1>vault</h1>
        <p id="selectedRoleText"></p>
        <form id="registrationForm">
            <div class="form-group">
                <label for="fname">First Name:</label>
                <input type="text" id="fname" name="fname" placeholder="Enter First Name" required>
            </div>
            <div class="form-group">
                <label for="mname">Middle Name:</label>
                <input type="text" id="mname" name="mname" placeholder="Enter Middle Name" required>
            </div>
            <div class="form-group">
                <label for="lname">Last Name:</label>
                <input type="text" id="lname" name="lname" placeholder="Enter Last Name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="abc@gmail.com" required>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Re-enter Password" required>
            </div>
            <button type="submit">Register</button>
        </form>
        <p id="error-message" class="error-message"></p>
       

    </div>

    <script src="register.js"></script>
    
</body>
</html>
   
<?php

if (isset($_POST['fname'])) {
    // Fetch form data
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];  
    $confirmPassword = $_POST['confirmPassword'];

    // Check if username already exists
    $sql = "SELECT username FROM student_register WHERE username='$username'";
    $res = mysqli_query($db, $sql);

    if (!$res) {
        echo "Error: " . mysqli_error($db);
        exit(); 
    }

    $count = mysqli_num_rows($res);

    if ($count == 0) {
        if ($password === $confirmPassword) {
            // Insert user into the database
            $insertQuery = "INSERT INTO student_register (fname, mname, lname, email, username, password)
                            VALUES ('$fname', '$mname', '$lname', '$email', '$username', '$password')";
            
            if (mysqli_query($db, $insertQuery)) {
                echo "Registration successful.";
            } else {
                echo "Error: " . mysqli_error($db); // For debugging if the query fails
            }
            
        } else {
            echo "Passwords do not match.";
        }
    } else {
        echo "The username already exists.";
    }
}
?>

</body>
</html>

