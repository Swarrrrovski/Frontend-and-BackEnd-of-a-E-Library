<?php
include "connection.php"; 
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vault_library_management"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['login_student'])) {
    die("Unauthorized access. Please log in.");
}

$login_user = $_SESSION['login_student'];

// Initialize messages
$email_update_msg = '';
$password_update_msg = '';
$account_delete_msg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // If the email update form is submitted
    if (isset($_POST['email'])) {
        $new_email = $_POST['email'];

        // Prepare and execute email update statement
        $stmt = $conn->prepare("UPDATE student_register SET email = ? WHERE username = ?");
        $stmt->bind_param("ss", $new_email, $login_user);

        if ($stmt->execute()) {
            $email_update_msg = "Email updated successfully!";
        } else {
            $email_update_msg = "Error updating email: " . $stmt->error;
        }

        $stmt->close();
    }

    // If the password change form is submitted
    if (isset($_POST['newPassword']) && isset($_POST['currentPassword'])) {
        $current_password = $_POST['currentPassword'];
        $new_password = $_POST['newPassword'];
        $confirm_new_password = $_POST['confirmNewPassword'];

        // First, verify the current password
        $stmt = $conn->prepare("SELECT password FROM student_register WHERE username = ?");
        $stmt->bind_param("s", $login_user);
        $stmt->execute();
        $stmt->bind_result($stored_password);
        $stmt->fetch();
        $stmt->close();

        // Assuming passwords are stored in plain text (not hashed)
        if ($current_password === $stored_password) {
            // Check if new password matches the confirmation password
            if ($new_password === $confirm_new_password) {
                // Update the password in the database
                $stmt = $conn->prepare("UPDATE student_register SET password = ? WHERE username = ?");
                $stmt->bind_param("ss", $new_password, $login_user);

                if ($stmt->execute()) {
                    $password_update_msg = "Password changed successfully!";
                } else {
                    $password_update_msg = "Error updating password: " . $stmt->error;
                }

                $stmt->close();
            } else {
                $password_update_msg = "New password and confirm password do not match.";
            }
        } else {
            $password_update_msg = "Current password is incorrect.";
        }
    }

    // If the account delete form is submitted
    if (isset($_POST['deleteAccount'])) {
        // Prepare and execute delete statement
        $stmt = $conn->prepare("DELETE FROM student_register WHERE username = ?");
        $stmt->bind_param("s", $login_user);

        if ($stmt->execute()) {
            // Account deleted, destroy session
            session_destroy();
            $account_delete_msg = "Account deleted successfully!";
            header("Location: ind.php"); // Redirect to login page after deletion
            exit();
        } else {
            $account_delete_msg = "Error deleting account: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>vault-Settings</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="settings.css">
</head>
<body>
    <header>
        <h1>Settings</h1>
        <i class="bi bi-brightness-high-fill" id="toggleDark"></i>
    </header>

    <div class="settings-container">
        <aside class="sidebar">
            <ul>
                <li data-section="accountInfo"><i class="bi bi-person-fill"></i>&nbsp;&nbsp;Account</li>
                <li data-section="changePassword"><i class="bi bi-key-fill"></i>&nbsp;&nbsp;Password</li>
                <li data-section="closeAccount"><i class="bi bi-person-x-fill"></i>&nbsp;&nbsp;Close Account</li>
            </ul>
        </aside>

        <main class="content">
            <!-- Account Information Section -->
            <section id="accountInfo" class="settings-section active">
                <h2>Account Information</h2>
                <form id="accountForm" action="settings.php" method="post">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($login_user); ?>" disabled>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="user@example.com">

                    <button type="submit">Save Changes</button>
                </form>
                <p><?php echo $email_update_msg; ?></p>
            </section>

            <!-- Change Password Section -->
            <section id="changePassword" class="settings-section">
                <h2>Change Password</h2>
                <form id="passwordForm" action="settings.php" method="post">
                    <label for="currentPassword">Current Password:</label>
                    <input type="password" id="currentPassword" name="currentPassword" placeholder="Enter current password" required>

                    <label for="newPassword">New Password:</label>
                    <input type="password" id="newPassword" name="newPassword" placeholder="Enter new password" required>

                    <label for="confirmNewPassword">Confirm Password:</label>
                    <input type="password" id="confirmNewPassword" name="confirmNewPassword" placeholder="Confirm new password" required>

                    <button type="submit">Change Password</button>
                </form>
                <p><?php echo $password_update_msg; ?></p>
            </section>

            <!-- Close Account Section -->
            <section id="closeAccount" class="settings-section">
                <h2>Close Account</h2>
                <p>This action cannot be undone.</p>
                <form id="deleteAccountForm" action="settings.php" method="post">
                    <input type="hidden" name="deleteAccount" value="true">
                    <button class="danger" id="deleteAccountBtn" type="submit">Delete Account</button>
                </form>
                <p><?php echo $account_delete_msg; ?></p>
            </section>
        </main>
    </div>

    <script src="settings.js"></script>
</body>
</html>
