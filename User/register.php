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

        <form id="registrationForm" action="" method="post">
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
        <p>Already registered? <a href="login.php">Login</a></p>
    </div>

    <script src="User/register.js"></script>

    <script>
        
        function selectRole(role) {
            document.getElementById('selectedRoleText').textContent = 'Selected Role: ' + role;
            document.getElementById('registrationContainer').style.display = 'block';
        }
    </script>
     <?php

if(isset($_POST['submit']))
{
  $count=0;

  $sql="SELECT username from `student`";
  $res=mysqli_query($db,$sql);

  while($row=mysqli_fetch_assoc($res))
  {
    if($row['username']==$_POST['username'])
    {
      $count=$count+1;
    }
  }
  if($count==0)
  {
    mysqli_query($db,"INSERT INTO `STUDENT` VALUES('$_POST[first]', '$_POST[last]', '$_POST[username]', '$_POST[password]', '$_POST[roll]', '$_POST[email]', '$_POST[contact]', 'p.jpg');");
  ?>
    <script type="text/javascript">
     alert("Registration successful");
    </script>
  <?php
  }
  else
  {

    ?>
      <script type="text/javascript">
        alert("The username already exist.");
      </script>
    <?php

  }

}

?>
</body>
</html>
