<?php 
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vault - Registration</title>
    <link rel="stylesheet" href="register.css">
    <link rel="shortcut icon" href="book.png" type="image/x-icon">
</head>
<body>

    <div class="role-selection">
        <h1>Register</h1>
        <!-- Buttons for role selection -->
        <button class="role-btn" type="button" onclick="selectRole('Admin')">Admin</button>
        <button class="role-btn" type="button" onclick="selectRole('User')">User</button>
    </div>

    <!-- Registration form (hidden initially) -->
    <div class="registration-container" id="registrationContainer" style="display: none;">
        <h1>Vault Registration</h1>
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
        
        <script src="register.js"></script> 
    </div>

    <script>
        function selectRole(role) {
            document.getElementById('selectedRoleText').textContent = 'Selected Role: ' + role;
            document.getElementById('registrationContainer').style.display = 'block';
        }

        document.getElementById('registrationForm').addEventListener('submit', async function(event) {
            event.preventDefault();

            // Form field validation logic (as in the original JS code)
            var pw1 = document.getElementById("password").value;
            var pw2 = document.getElementById("confirmPassword").value;
            var fname = document.getElementById("fname").value;
            var lname = document.getElementById("lname").value;
            var username = document.getElementById("username").value;

            document.getElementById("error-message").innerHTML = "";

            if (fname === "" || lname === "" || username === "" || pw1 === "" || pw2 === "") {
                document.getElementById("error-message").innerHTML = "All fields are required.";
                return;
            }

            if (pw1 !== pw2) {
                document.getElementById("error-message").innerHTML = "Passwords do not match.";
                return;
            }

            if (pw1.length < 8) {
                document.getElementById("error-message").innerHTML = "Password must be at least 8 characters long.";
                return;
            }

            // Prepare form data
            const formData = new FormData(this);

            // Send form data via AJAX request using fetch
            try {
                const response = await fetch('register.php', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.text(); // Get response from PHP file

                if (response.ok) {
                    alert('Registration successful');
                    // Redirect to ind.php page using JavaScript
                    window.location.href = 'ind.php';
                } else {
                    document.getElementById('error-message').innerHTML = result;
                }
            } catch (error) {
                console.error('Error:', error);
                document.getElementById('error-message').innerHTML = 'Registration failed. Please try again.';
            }
        });
    </script>
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
    $sql = "SELECT username FROM `student_register` WHERE username='$username'";
    $res = mysqli_query($db, $sql);

    if (!$res) {
        echo "Error: " . mysqli_error($db);
        exit(); 
    }

    $count = mysqli_num_rows($res);

    if ($count == 0) {
        if ($password === $confirmPassword) {
            // Insert user into the database
            $insertQuery = "INSERT INTO `student_register` (fname, mname, lname, email, username, password)
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
