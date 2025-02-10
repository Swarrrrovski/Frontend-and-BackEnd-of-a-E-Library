<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>vault - Login</title>
    <link rel="stylesheet" href="user_login.css">
    <link rel="shortcut icon" href="book.png" type="image/x-icon">
</head>
<body>
    <div class="login-container">
        <h1>Vault Admin</h1>
        <form id="loginForm">
            <div class="form-group">
                <label for="role">Login as:</label>
                <select id="role" name="role" required>
                    <option value="" disabled selected>Select Role</option>
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
            <button type="submit">Login</button>
        </form>
        <p id="error-message" class="error-message"></p>
        <p>Not registered yet? <a href="register.php">Register Now</a></p>
    </div>
    <script src="admin_login.js"></script>
    
</body>
</html>