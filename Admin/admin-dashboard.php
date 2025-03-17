<?php
// Start the session
session_start();

// Check if the admin is logged in, otherwise redirect to login page (ind.php)
if (!isset($_SESSION['login_user'])) {
    header("Location: ind.php");
    exit();
}

// Include database connection
$servername = "localhost"; // Replace with your server name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "vault_library_management"; // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the admin's information from the database
$login_username = $_SESSION['login_user'];
$sql = "SELECT fname, mname, lname, email, username FROM admin_register WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $login_username);
$stmt->execute();
$result = $stmt->get_result();

// Check if the admin is found
if ($result->num_rows > 0) {
    // Fetch the admin data
    $admin = $result->fetch_assoc();
} else {
    // If no admin found, redirect to login
    header("Location: ind.php");
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>vault-Admin</title>
    <link rel="stylesheet" href="admin_dashboard.css">
    <link rel="shortcut icon" href="book.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <header>
        <button id="menuToggle" class="menu-button"><i class="bi bi-list"></i><span class="menu-text">Menu</span></button>
        <h1>Admin Dashboard</h1>
        <button id="themeToggle"><i class="bi bi-brightness-high-fill"></i></button>
        
        <!-- Logout button wrapped in form -->
        <form method="post" action="logout.php" style="display: inline;">
            <button type="submit" id="logoutBtn" class="logoutBtn">
                <i class="bi bi-box-arrow-right"></i><span class="logout-text">Logout</span>
            </button>
        </form>
    </header>
    
    <div class="container">
        <aside class="sidebar">
            <ul>
                <li><a href="admin-dashboard.php"><i class="bi bi-house-fill"></i>&nbsp;Home</a></li>
                <li><a href="Book.php"><i class="bi bi-book-fill"></i>&nbsp;&nbsp;Manage Books</a></li>
                <li><a href="student.php"><i class="bi bi-person-fill"></i>&nbsp;&nbsp;Manage Users</a></li>
                <li><a href="settings.php"><i class="bi bi-gear-fill"></i>&nbsp;&nbsp;Edit Account</a></li>
                <li><a href="fine.php"><i class="bi bi-credit-card-fill"></i>&nbsp;&nbsp;Due Payments</a></li>
            </ul>
        </aside>
        
        <main class="content">
            <h2>Welcome Back, <?php echo htmlspecialchars($admin['fname']); ?>!</h2>
            <section class="admin-info">
                <h3>Your Profile Information:</h3>
                <ul>
                    <li><strong>First Name:</strong> <?php echo htmlspecialchars($admin['fname']); ?></li>
                    <li><strong>Middle Name:</strong> <?php echo htmlspecialchars($admin['mname']); ?></li>
                    <li><strong>Last Name:</strong> <?php echo htmlspecialchars($admin['lname']); ?></li>
                    <li><strong>Email:</strong> <?php echo htmlspecialchars($admin['email']); ?></li>
                    <li><strong>Username:</strong> <?php echo htmlspecialchars($admin['username']); ?></li>
                </ul>
            </section>
        </main>
    </div>

    <script src="admin_dashboard.js"></script>
</body>
</html>
