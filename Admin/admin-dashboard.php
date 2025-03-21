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
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Poppins:wght@400;500&display=swap');

:root {
    --base-color: white;
    --base-variant:hsla(233, 100.00%, 98.40%, 0.9);
    --text-color:rgb(0, 0, 0);
    --text-
    --primary-color: #3a435d;
    --secondary-text: #232738;
    --accent-color: #0071ff;
    --header-bg: #007bff;
    --sidebar-bg:rgba(219, 231, 255, 0.83);
    --hover-bg: #abc8fc;
    text-shadow: 1px 1px 2px rgba(255, 246, 246, 0.94); /* Shadow effect behind text */
}

.dark-mode {
    --base-color: black;
    --base-variant: #444;
    --text-color:rgb(224, 222, 222);
    --primary-color:rgba(0, 0, 1, 0.79);
    --secondary-text:rgba(0, 0, 6, 0.54);
    --accent-color: #0071ff;
    --header-bg: #007bff;
    --sidebar-bg: #444;
    --hover-bg: #5a5959;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.94); /* Shadow effect behind text */
}

body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background-color: var(--base-color);
    color: var(--text-color);
    transition: all 0.3s ease-in-out;
    background-image:url('Images/im8.png');
    background-size: cover; /* Ensure the image covers the entire body */
   background-position: center center; /* Center the image both horizontally and vertically */
   background-attachment: fixed; /* Keeps the background image fixed while scrolling */
  margin: 0;
  padding: 0;
  
   


}

header {
    background-color: var(--header-bg);
    color: whitesmoke;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
}

header h1 {
    font-size: 30px;
    font-family: "Montserrat", serif;
    text-shadow: 4px 4px 4px black;
    flex-grow: 1;
    text-align: center;
}

.menu-container {
    display: flex;
    align-items: center;
    gap: 10px;
}

.header-right {
    display: flex;
    align-items: center;
    gap: 10px;
}

.menu-button, .logoutBtn {
    font-size: 20px;
    background: none;
    border: none;
    padding: 0;
    padding-right: 5px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 5px;
}

.menu-text, .logout-text {
    font-size: 18px;
    color: var(--text-color);
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    font-weight: 500;
}

#themeToggle {
    background: var(--accent-color);
    border: none;
    padding: 8px;
    margin-right: 30px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 20px;
    color: white;
}

.container {
    display: flex;
}

.sidebar {
    background-color: var(--sidebar-bg);
    width: 250px;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    padding: 20px;
    border-radius: 15px;
    height: 75vh;
    margin: 20px auto;
    margin-left: 20px;
}

.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar ul li {
    margin: 15px 0;
}

.sidebar ul li a {
    color: var(--text-color);
    text-decoration: none;
    font-size: 18px;
    padding: 10px;
    display: block;
    border-radius: 5px;
}

.sidebar ul li a:hover {
    background-color: var(--hover-bg);
}

.content {
    flex: 1;
    margin-left: 20px;
    
}

h2 {
    font-size: 28px;
    margin-bottom: 20px;
}

section {
    margin-bottom: 40px;
    background: var(--base-variant);
    padding: 15px;
    border-radius: 5px;
}

.borrowed-books, .purchased-books, .due-payments, .subscription, .recommendations {
    background: var(--sidebar-bg);
}

#bookList, #purchasedList, #duePayments, #recommendedBooks {
    margin-top: 10px;
}

#bookList li, #purchasedList li, #duePayments li {
    padding: 10px;
    background-color: var(--hover-bg);
    margin: 5px 0;
    border-radius: 5px;
    color: var(--text-color);
}


        </style>
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
                
                
                <ul>
                <h2>Your Profile Information:</h2>
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
